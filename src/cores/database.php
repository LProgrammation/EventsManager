<?php 

namespace src\cores ; 

use \PDO ;
use \PDOException ;
use MongoDB\Client ;
class Database 
{
    private $host ;
    private $db_name  ;
    private $username   ;
    private $password ;

    private static $instance = null;
    private $pdo;

    private $mongoDbClient ; 
    private $hostMongoDb ; 
    private $databaseMongoDb ; 

    private function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $this->hostMongoDb = $_ENV['MONGO_URI'];
        $this->databaseMongoDb = $_ENV['MONGO_DB'];
        $this->mongoDbClient = new Client($this->hostMongoDb);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        
        return self::$instance;
    }
  

    public function getConnectionPdo() {
        return $this->pdo;
    }
           
    public function getConnectionMongoDb() {
        return $this->mongoDbClient->selectDatabase($this->databaseMongoDb);
    }
}