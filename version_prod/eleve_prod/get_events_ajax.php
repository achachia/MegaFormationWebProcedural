<?php

require_once './connection/config.php';
ini_set('date.timezone', 'Europe/Paris');
$etat = TRUE;
$events = array();
try {
    $sql = 'SELECT * FROM Calendar_eleves';

    foreach ($cxn->query($sql) as $row) {

        $events[] = $row;
    }
} catch (PDOException $e) {

    echo json_encode(array('error' => 'Connection failed: ' . $e->getMessage()));
}
echo json_encode($events);
?>

