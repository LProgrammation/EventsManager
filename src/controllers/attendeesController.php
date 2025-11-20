<?php

namespace src\controllers;
use src\controllers\AbstractController;
class AttendeesController extends AbstractController
{
    private $attendeesService;
    private $eventsService;
    
    public function __construct($database = null)
    {
        parent::__construct($database);
        $this->attendeesService = new \src\services\AttendeesService($this->database);
        $this->eventsService = new \src\services\EventsService($this->database);
    }
    /**
     * Show register to event form
     * @return void
     */
    public function registerToEvents()
    {
        $events = $this->eventsService->getAllEvents();
        $this->render('events/registerAttendee', ['title' => 'Register to Events', 'events' => $events]);
    }
    /**
     * Submit the register form values
     * @return void
     */
    public function registerSubmit()
    {
        $this->attendeesService->registerAttendeeToEvent(
            $_POST['event_id'],
            $_POST['first_name'],
            $_POST['last_name'],
            date('Y-m-d')
        );
        header('Location: /events');
        exit();
    }

    public function unregisterFromEvents()
    {
        $events = $this->eventsService->getAllEvents();
        $this->render('events/unregisterAttendee', ['title' => 'Unregister from Events', 'events' => $events]);
    }

    public function unregisterSubmit()
    {
        $this->attendeesService->unregisterAttendeeFromEvent(
            $_POST['event_id'],
            $_POST['first_name'],
            $_POST['last_name']
        );
        header('Location: /events');
        exit();
    }
    

}