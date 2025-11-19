<?php 

namespace src\cores ; 

use \PDO ;
use \PDOException ;

class Database 
{
    private $host ;
    private $db_name  ;
    private $username   ;
    private $password ;

    private static $instance = null;
    private $pdo;

    private function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->db_name = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->pdo = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        
        return self::$instance;
    }

    public function getConnection() {
        return $this->pdo;
    }
}