<?php

namespace Src\Controllers;
use Src\Controllers\AbstractController;
class EventsController extends AbstractController
{
    private $eventsService;

    public function __construct($database = null)
    {
        parent::__construct($database);
        $this->eventsService = new \Src\Services\EventsService($this->database);
    }
    /**
     * List all events
     * @return void
     */
    public function index()
    {
        $events = $this->eventsService->getAllEvents();
        $this->render('events/index', ['title' => 'Liste des événements', 'events' => $events]);
    }
    /**
     * show create event form
     * @return void
     */
    public function createEvent()
    {
        $this->render('events/createEvent', ['title' => 'Créer un événement']);
    }
    /**
     * Submit the create event form values
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
     * Show edit event dates form
     * @return void
     */
    public function editEventDates()
    {
        $events = $this->eventsService->getAllEvents();
        $this->render('events/editEventDates', ['title' => 'Modifier la date', 'events' => $events]);
    }
    /**
     * Submit the edit event dates form values
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
    /**
     * Delete event by id
     * @return void
     */
    public function deleteEvent($id)
    {
        $this->eventsService->deleteEvent($id);
        header('Location: /events');
        exit();
    }
    /**
     * Show import event form
     * @return void
     */
    public function importEvent(){
        $this->render('events/importEvent', ['title' => 'Importer un événement']);
    }
    /**
     * Import event from source form submit
     * @return void
     */
    public function importEventSubmit(){
        $sourceName = $_POST['sourceName'];
        $this->eventsService->importEventsFromSourceName($sourceName);
        header('Location: /events');
        exit();
    }

}