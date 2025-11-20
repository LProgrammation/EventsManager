<?php

require __DIR__ . '/../vendor/autoload.php';
use MongoDB\Client;

$client = new Client("mongodb://localhost:27017");
$db = $client->events_manager;


/**
 * 1 — FICHIER JSON 1
 */
function insertDatas($db, $name) {
    $path = __DIR__ . "/$name.json";

    if (!file_exists($path)) return;

    $data = json_decode(file_get_contents($path), true);
    $collection = $db->$name;

    foreach ($data as $doc) {
        $collection->insertOne($doc);
    }

    echo "✔ Données insérées pour $name.json\n";
}





/**
 * Appel des trois fonctions
 */
insertDatas($db, 'disisfine');
insertDatas($db, 'liveticket');
insertDatas($db, 'truegister');

echo "\n Insertion terminée pour tous les fichiers !\n";