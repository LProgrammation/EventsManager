<?php 

namespace Src\cores ; 


class DatabaseFactory 
{
    private $instances = [];
    /**
     * Get database instance
     * @param string $dbName
     * @param string $type
     * @return Database
     */
    public function getInstance($dbName, $type = 'mariadb') {
        $key = $dbName . '_' . strtolower($type);
        if (!isset($this->instances[$key])) {
            $this->instances[$key] = new Database($dbName, $type);
        }
        return $this->instances[$key];
    }
    /**
     * Get database connection
     * @param string $dbName
     * @param string $type
     * @return mixed
     */
    public function getDatabase($dbName, $type = 'mariadb') {
        return $this->getInstance($dbName, $type)->getConnection();
    }
}