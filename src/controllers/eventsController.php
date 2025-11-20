<?php 

namespace src\controllers;
use src\controllers\AbstractController;
class EventsController extends AbstractController {
    private $eventsService;

    public function __construct() {
        $this->eventsService = new \src\services\EventsService();
    }

    public function index(){
        $events = $this->eventsService->getAllEvents();
        $this->render('events/index', ['title' => 'Liste des événements', 'events' => $events]);
    }

    public function registerToEvents(){
        $events = $this->eventsService->getAllEvents();
        $this->render('events/register', ['title' => 'Register to Events', 'events' => $events]);
    }
    public function registerSubmit(){
        $events = $this->eventsService->registerPersonToEvent(
            $_POST['event_id'], 
            $_POST['first_name'], 
            $_POST['last_name']
        );
    }
    public function editEventDate(){
    $events = $this->eventsService->getAllEvents();
    $this->render('events/editDate', ['title' => 'Modifier la date', 'events' => $events]);
}

public function updateEventSubmit(){
    $this->eventsService->updateEventDate(
        $_POST['event_id'],
        $_POST['new_date']
    );
}

}