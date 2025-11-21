<?php

namespace Src\Services;

use Src\Dto\AttendeesDto;
use Src\Dto\EventsDto;
use Src\Services\AttendeesService ;

class EventsService
{
    private $eventsRepository;
    private $database;
    public function __construct(array $database)
    {
        $this->database = $database;
        $this->eventsRepository = new \Src\Repositories\eventsRepository($this->database);
    }
    /**
     * Get all events from the database
     * @return array
     */
    public function getAllEvents(): array
    {
        return $this->eventsRepository->getEvents();
    }
    /**
     * Update event dates
     * @param int $event_id
     * @param string $new_start_date
     * @param string $new_end_date
     * @return void
     */
    public function updateEventDates($event_id, $new_start_date, $new_end_date)
    {
        $this->eventsRepository->updateEventDates($event_id, $new_start_date, $new_end_date);
    }
    /**
     * Create event
     * @param mixed $event_name
     * @param mixed $event_location
     * @param mixed $start_date
     * @param mixed $end_date
     * @param mixed $max_attendees
     * @return int
     */
    public function createEvent($event_name, $event_location, $start_date, $end_date, $max_attendees)
    {
        return $this->eventsRepository->createEvent($event_name, $event_location, $start_date, $end_date, $max_attendees);
    }
    /**
     * Delete event by id
     * @param mixed $id
     * @return void
     */
    public function deleteEvent($id)
    {
        $this->eventsRepository->deleteEvent($id);
    }
    /**
     * Import events from source name
     * @param string $sourceName
     * @return void
     */
    public function importEventsFromSourceName(string $sourceName)
    {
        $documents = $this->convertEventsDatasFromApi($sourceName);
        $attendeesService = new AttendeesService($this->database) ;
        foreach ($documents as $document) {
            $event = $document['event'];
            $eventId = $this->createEvent(
                $event['event_name'],
                $event['event_location'],
                $event['start_date'],
                $event['end_date'],
                $event['max_attendees'] ?? 5
            );
            foreach ($document['attendees'] as $attendee) {
                $attendeesService->registerAttendeeToEvent(
                    $eventId,
                    $attendee['first_name'],
                    $attendee['last_name'],
                    $attendee['registration_date'] ?? date('Y-m-d'),
                ) ;
            }
        }
    }
    /**
     * Convert events data from API to internal format
     * @param string $apiName
     * @return array
     */
    private function convertEventsDatasFromApi(string $apiName)
    {
        $eventsDatas = $this->eventsRepository->getApiEventsDatasByCollectionName($apiName);
        $documents = [];
        switch ($apiName) {
            case 'disisfine':
                foreach ($eventsDatas as $event) {
                    $document = [];
                    $eventsDto = new EventsDto(
                        $event['e_name'],
                        $event['e_location'],
                        $event['e_start'],
                        $event['e_finish'],
                        $event['e_attendees_max']
                    );
                    $document['event'] = $eventsDto->getEvent();
                    foreach ($event['attendees'] as $event_attendee) {
                        $attendeeDto = new AttendeesDto(
                            $event_attendee[0],
                            $event_attendee[1],
                            $event_attendee[2],
                        );
                        $document['attendees'][] = $attendeeDto->getAttendee();
                    }
                    $documents[] = $document;
                }
                break;
            case 'liveticket':
                foreach ($eventsDatas as $event) {
                    $document = [];
                    $eventsDto = new EventsDto(
                        $event['event'],
                        $event['where'],
                        $event['start'],
                        $event['end'],
                        $event['max']
                    );
                    $document['event'] = $eventsDto->getEvent();
                    foreach ($event['attendees'] as $event_attendee) {
                        $attendeeDto = new AttendeesDto(
                            $event_attendee['fn'],
                            $event_attendee['ln'],
                            $event_attendee['when'],
                        );
                        $document['attendees'][] = $attendeeDto->getAttendee();
                    }
                    $documents[] = $document;
                }
                break;
            case 'truegister':
                foreach ($eventsDatas as $eventData) {
                    foreach ($eventData as $event) {
                        if ($event instanceof \MongoDB\BSON\ObjectId) {
                            continue;
                        }
                        $eventObj = $event['event'];
                        $attendeesObj = $event['attendees'];
                        $document = [];
                        $eventsDto = new EventsDto(
                            $eventObj['event_name'],
                            $eventObj['event_where'],
                            $eventObj['event_begin'],
                            $eventObj['event_finish'],
                            5
                        );
                        $document['event'] = $eventsDto->getEvent();
                        foreach ($attendeesObj as $event_attendee) {
                            $attendeeDto = new AttendeesDto(
                                $event_attendee['attendee_1'],
                                $event_attendee['attendee_2'],
                                null
                            );
                            $document['attendees'][] = $attendeeDto->getAttendee();
                        }
                        $documents[] = $document;
                    }
                }
                break;
            }
        return $documents;
    }
}