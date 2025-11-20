<?php 

namespace src\cores ; 


class DatabaseFactory 
{
    private $instances = [];

    public function getInstance($dbName, $type = 'mariadb') {
        $key = $dbName . '_' . strtolower($type);
        if (!isset($this->instances[$key])) {
            $this->instances[$key] = new Database($dbName, $type);
        }
        return $this->instances[$key];
    }

    public function getDatabase($dbName, $type = 'mariadb') {
        return $this->getInstance($dbName, $type)->getConnection();
    }
}