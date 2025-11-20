<?php 

namespace src\cores;

class Database {
    private $dbName;
    private $type;
    private $connection;

    public function __construct($dbName, $type = 'mysql') {
        $this->dbName = $dbName;
        $this->type = strtolower($type);

        if ($this->type === 'mysql' || $this->type === 'mariadb') {
            $host = $_ENV['DB_HOST'] ?? 'localhost';
            $user = $_ENV['DB_USER'] ?? 'root';
            $password = $_ENV['DB_PASSWORD'] ?? '';
            $dsn = "mysql:host={$host};dbname={$dbName};charset=utf8mb4";
            $this->connection = new \PDO($dsn, $user, $password);
        } elseif ($this->type === 'mongodb') {
            $host = $_ENV['MONGO_HOST'] ?? 'localhost';
            $port = $_ENV['MONGO_PORT'] ?? '27017';
            $user = $_ENV['MONGO_USER'] ?? '';
            $password = $_ENV['MONGO_PASSWORD'] ?? '';
            $uri = "mongodb://";
            if ($user && $password) {
                $uri .= "{$user}:{$password}@";
            }
            $uri .= "{$host}:{$port}";
            $client = new \MongoDB\Client($uri);
            $this->connection = $client->selectDatabase($dbName);
        } else {
            throw new \Exception("Unsupported database type: {$type}");
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}