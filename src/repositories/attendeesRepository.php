<?php

namespace Src\Repositories;
class AttendeesRepository
{
    private $pdo;
    private $mongodb ; 

    public function __construct($database)
    {
        $this->pdo = $database['mariadb'];
        $this->mongodb = $database['mongodb'];
    }
    /**
     * Execute registerAttendeesToEvent sql procedures
     * @param mixed $event_id
     * @param mixed $first_name
     * @param mixed $last_name
     * @return void
     */
    public function registerAttendeeToEvent($event_id, $first_name, $last_name, $registration_date)
    {
        $stmt = $this->pdo->prepare("CALL registerAttendeeToEvent(:event_id, :first_name, :last_name, :registration_date)");
        $stmt->bindParam(':event_id', $event_id, \PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $first_name, \PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, \PDO::PARAM_STR);
        $stmt->bindParam(':registration_date', $registration_date, \PDO::PARAM_STR);
        $stmt->execute();
    }
    /**
     * Execute unregisterAttendeeFromEvent sql procedures
     * @param mixed $event_id
     * @param mixed $first_name
     * @param mixed $last_name
     * @return void
     */
    public function unregisterAttendeeFromEvent($event_id, $first_name, $last_name)
    {
        $stmt = $this->pdo->prepare("CALL unregisterAttendeeFromEvent(:first_name, :last_name, :event_id)");
        $stmt->bindParam(':event_id', $event_id, \PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $first_name, \PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, \PDO::PARAM_STR);
        $stmt->execute();
    }
}