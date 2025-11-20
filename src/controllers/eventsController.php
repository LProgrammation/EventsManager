<?php

namespace src\controllers;
use src\controllers\AbstractController;
class EventsController extends AbstractController
{
    private $eventsService;

    public function __construct($database = null)
    {
        parent::__construct($database);
        $this->eventsService = new \src\services\EventsService($this->database);
    }
    /**
     * Show all events
     * @return void
     */
    public function index()
    {
        $events = $this->eventsService->getAllEvents();
        $this->render('events/index', ['title' => 'Liste des événements', 'events' => $events]);
    }
    /**
     * Show create event form
     * @return void
     */
    public function createEvent()
    {
        $this->render('events/createEvent', ['title' => 'Créer un événement']);
    }
    /**
     * submit the event form values
     * @return void
     */
    public function createEventSubmit()
    {
        $this->eventsService->createEvent(
            $_POST['event_name'],
            $_POST['event_location'],
            $_POST['start_date'],
            $_POST['end_date'],
            $_POST['max_attendees'] ?? 5
        );
        header('Location: /events');
        exit;

    }
    /**
     * show event dates edition form
     * @return void
     */
    public function editEventDates()
    {
        $events = $this->eventsService->getAllEvents();
        $this->render('events/editEventDates', ['title' => 'Modifier la date', 'events' => $events]);
    }
    /**
     * Submit the event dates edition form values
     * @return void
     */
    public function updateEventSubmit()
    {
        $this->eventsService->updateEventDates(
            $_POST['event_id'],
            $_POST['new_start_date'],
            $_POST['new_end_date']
        );
        header('Location: /events');
        exit();
    }

    public function deleteEvent($id)
    {
        $this->eventsService->deleteEvent($id);
        header('Location: /events');
        exit();
    }

    public function importEvent(){
        $this->render('events/importEvent', ['title' => 'Importer un événement']);
    }
    public function importEventSubmit(){
        $sourceName = $_POST['sourceName'];
        $this->eventsService->importEventFromSource($sourceName);
        header('Location: /events');
        exit();
    }

}