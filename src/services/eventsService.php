<?php

namespace src\services ; 


class EventsService {
    private $eventsRepository;

    public function __construct() {
        $this->eventsRepository = new \src\repositories\eventsRepository();
    }

    public function getAllEvents():array  {
        return $this->eventsRepository->getEvents();
    }

    public function getEventDetails($id): array {
        return $this->eventsRepository->getEventById($id);
    }

    public function registerPersonToEvent(string $event_id, string $first_name, string $last_name): void {
        $this->eventsRepository->registerPersonToEvent($event_id, $first_name, $last_name);
    }
    public function updateEventDate($event_id, $new_date){
    $repo = new \src\repositories\eventsRepository();
    return $repo->updateEventDate($event_id, $new_date);
}

}