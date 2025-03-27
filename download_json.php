<?php
session_start();

if (isset($_SESSION['data'])) {
    $filename = $_GET['filename'];
    // JSON-Daten aus der Session holen
    $data = $_SESSION['data'];
    // JSON-Daten kodieren
    $jsonData = json_encode($data, JSON_PRETTY_PRINT);

    // Header setzen, um den Download zu erzwingen
    header('Content-Type: application/json');
    // header('Content-Disposition: attachment; filename="data.json"');
    header('Content-Disposition: attachment; filename="'.$filename.'"');
    header('Content-Length: ' . strlen($jsonData));

    // JSON-Daten ausgeben
    echo $jsonData;
    exit;
} else {
    echo "Keine Daten in der Session gefunden.";
}
?>