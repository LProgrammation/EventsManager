<?php

namespace Src\Repositories;
class EventsRepository
{
    private $pdo;
    private $mongodb ; 

    public function __construct($database)
    {
        $this->pdo = $database['mariadb'];
        $this->mongodb = $database['mongodb'];
    }
    /**
     * Get all events
     */
    public function getEvents()
    {
        $stmt = $this->pdo->prepare("CALL getEvents()");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    /**
     * Get event by id
     * @param mixed $id
     */
    public function getEventById($id)
    {
        $stmt = $this->pdo->prepare("CALL getEventById(:event_id)");
        $stmt->bindParam(':event_id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }
    /**
     * Update the events
     * @param mixed $event_id
     * @param mixed $new_start_date
     * @param mixed $new_end_date
     * @return void
     */
    public function updateEventDates($event_id, $new_start_date, $new_end_date)
    {
        $stmt = $this->pdo->prepare("CALL updateEventDates(:event_id, :new_start_date, :new_end_date)");
        $stmt->bindParam(':event_id', $event_id, \PDO::PARAM_INT);
        $stmt->bindParam(':new_start_date', $new_start_date, \PDO::PARAM_STR);
        $stmt->bindParam(':new_end_date', $new_end_date, \PDO::PARAM_STR);
        $stmt->execute();
    }
    /**
     * Create event
     * @param mixed $event_name
     * @param mixed $event_location
     * @param mixed $start_date
     * @param mixed $end_date
     * @param mixed $max_attendees
     * @return void
     */
    public function createEvent($event_name, $event_location, $start_date, $end_date, $max_attendees)
    {
        $stmt = $this->pdo->prepare("CALL createEvent(:event_name, :event_location, :start_date, :end_date, :max_attendees, @new_event_id)");
        $stmt->bindParam(':event_name', $event_name, \PDO::PARAM_STR);
        $stmt->bindParam(':event_location', $event_location, \PDO::PARAM_STR);
        $stmt->bindParam(':start_date', $start_date, \PDO::PARAM_STR);
        $stmt->bindParam(':end_date', $end_date, \PDO::PARAM_STR);
        $stmt->bindParam(':max_attendees', $max_attendees, \PDO::PARAM_INT);
        $stmt->execute();

        $result = $this->pdo->query("SELECT @new_event_id AS event_id")->fetch(\PDO::FETCH_ASSOC);
        return $result['event_id'];
    }
    /**
     * Delete event by id
     * @param mixed $event_id
     * @return void
     */
    public function deleteEvent($event_id)
    {
        $stmt = $this->pdo->prepare("CALL deleteEvent(:event_id)");
        $stmt->bindParam(':event_id', $event_id, \PDO::PARAM_INT);
        $stmt->execute();
    }
    /**
     * Get events data from mongodb by collection name
     * @param string $apiName
     * @return array
     */
    public function getApiEventsDatasByCollectionName(string $apiName){
        $collection = $this->mongodb->selectCollection($apiName);
        $documents = $collection->find()->toArray();
        $results = [];
        foreach ($documents as $document) {
            $results[] = $document; 
        }
        return $results;
    }
}