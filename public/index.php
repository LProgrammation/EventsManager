<?php 

use Dotenv\Dotenv;
use src\cores\Database;
use src\cores\Router;

require_once __DIR__ . '/../vendor/autoload.php';


$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

phpinfo();
// try {
//     if ($_SERVER['REQUEST_URI'] !== '/errors/1045') {
//         $db = Database::getInstance();
//         $pdo = $db->getConnection();
//     }
//     Router::dispatch();
// } catch (PDOException $e) {
//         header('Location: /errors/1045');
//         exit;
    
// }