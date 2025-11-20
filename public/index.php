<?php

use Dotenv\Dotenv;
use src\cores\DatabaseFactory;
use src\cores\Router;

require_once __DIR__ . '/../vendor/autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

$DatabaseFactory = new DatabaseFactory();
try {
    $database = [];
    if (parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) !== '/errors/504') {
        $DatabaseMariadb = $DatabaseFactory->getDatabase('events_manager', 'mariadb');
        $DatabaseMongoDB = $DatabaseFactory->getDatabase('events_manager', 'mongodb');
        $database = ['mariadb' => $DatabaseMariadb, 'mongodb' => $DatabaseMongoDB];
    }
    Router::dispatch($database);
} catch (PDOException $e) {
    $errorMsg = urlencode(string: $e->getMessage());
    header("Location: /errors/504?msg=$errorMsg");
    exit;

}