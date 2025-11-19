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
}