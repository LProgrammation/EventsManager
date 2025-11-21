<?php 

namespace Src\Services ;

class AttendeesService {
    private $attendeesRepository;
    private $database;
    public function __construct(array $database) {
        $this->database = $database;
        $this->attendeesRepository = new \Src\Repositories\attendeesRepository($this->database);
    }
    /**
     * Register attendee to event
     * @param int $event_id
     * @param string $first_name
     * @param string $last_name
     * @param string $register_date
     * @return void
     */
    public function registerAttendeeToEvent(int $event_id, string $first_name, string $last_name, string $register_date) {
        $this->attendeesRepository->registerAttendeeToEvent($event_id, $first_name, $last_name, $register_date);
    }
    /**
     * Unregister attendee from event
     * @param int $event_id
     * @param string $first_name
     * @param string $last_name
     * @return void
     */
    public function unregisterAttendeeFromEvent(int $event_id, string $first_name, string $last_name) {
        $this->attendeesRepository->unregisterAttendeeFromEvent($event_id, $first_name, $last_name);
    }
}