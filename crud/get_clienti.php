<?php
include '../config.php';

$sql = "SELECT * FROM az_clienti";
$result = $conn->query($sql);

// Creazione di un array contenente i dati estratti dalla tabella
$data = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Conversione dell'array in formato JSON e invio al client
header('Content-Type: application/json');
echo json_encode($data);

// Chiusura della connessione al database
$conn->close();
?>