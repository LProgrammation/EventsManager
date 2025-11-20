<?php 

namespace src\services ;

class AttendeesService {
    private $attendeesRepository;
    private $database;
    public function __construct(array $database) {
        $this->database = $database;
        $this->attendeesRepository = new \src\repositories\attendeesRepository($this->database);
    }

    public function registerAttendeeToEvent(int $event_id, string $first_name, string $last_name, string $register_date) {
        $this->attendeesRepository->registerAttendeeToEvent($event_id, $first_name, $last_name, $register_date);
    }

    public function unregisterAttendeeFromEvent(int $event_id, string $first_name, string $last_name) {
        $this->attendeesRepository->unregisterAttendeeFromEvent($event_id, $first_name, $last_name);
    }
}