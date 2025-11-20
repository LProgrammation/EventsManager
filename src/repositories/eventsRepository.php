<?php 

namespace src\repositories;
use src\cores\Database;
class EventsRepository {
    private $pdo;
    
    public function __construct() {
        $this->pdo = Database::getInstance()->getConnectionPdo();
        // $this->mongoDbClient = Database::getInstance()->getConnectionMongoDb();
    }

    
    public function getEvents(){
        $stmt = $this->pdo->prepare("CALL getEvents()");
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getEventById($id){
        $stmt = $this->pdo->prepare("CALL getEventById(:event_id)");
        $stmt->bindParam(':event_id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function registerPersonToEvent($event_id, $first_name, $last_name){
        $stmt = $this->pdo->prepare("CALL registerPersonToEvent(:event_id, :first_name, :last_name)");
        $stmt->bindParam(':event_id', $event_id, \PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $first_name, \PDO::PARAM_STR);
        $stmt->bindParam(':last_name', $last_name, \PDO::PARAM_STR);
        $stmt->execute();
        
    }
 public function updateEventDate($event_id, $new_date){
    $stmt = $this->pdo->prepare("CALL updateEventDate(:event_id, :new_date)");
    $stmt->bindParam(':event_id', $event_id, \PDO::PARAM_INT);
    $stmt->bindParam(':new_date', $new_date, \PDO::PARAM_STR);
    $stmt->execute();
}

}