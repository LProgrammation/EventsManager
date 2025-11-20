<?php

namespace src\services;

use src\dto\AttendeesDto;

use src\dto\EventsDto;

use src\services\AttendeesService ;

class EventsService
{
    private $eventsRepository;
    private $database;
    public function __construct(array $database)
    {
        $this->database = $database;
        $this->eventsRepository = new \src\repositories\eventsRepository($this->database);
    }

    public function getAllEvents(): array
    {
        return $this->eventsRepository->getEvents();
    }

    public function getEventDetails($id): array
    {
        return $this->eventsRepository->getEventById($id);
    }


    public function updateEventDates($event_id, $new_start_date, $new_end_date)
    {

        $this->eventsRepository->updateEventDates($event_id, $new_start_date, $new_end_date);
    }

    public function createEvent($event_name, $event_location, $start_date, $end_date, $max_attendees)
    {
        return $this->eventsRepository->createEvent($event_name, $event_location, $start_date, $end_date, $max_attendees);
    }
    public function deleteEvent($id)
    {
        $this->eventsRepository->deleteEvent($id);
    }
    
    
    
    public function importEventFromSource(string $sourceName)
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
                        // Skip the _id field
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