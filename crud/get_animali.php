<?php
include '../config.php';
$id = $_POST['id_cliente'];

if ($id == '') {
    $sql = "SELECT * FROM az_animali";
    $result = $conn->query($sql);

    // Creazione di un array contenente i dati estratti dalla tabella
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Conversione dell'array in formato JSON e invio al client
    header('Content-Type: application/json');
    echo json_encode($data);

    // Chiusura della connessione al database
    $conn->close();
} else {
    $sql = "SELECT * FROM az_animali WHERE id_cliente = " . $id;
    $result = $conn->query($sql);

    // Creazione di un array contenente i dati estratti dalla tabella
    $data = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
    }

    // Conversione dell'array in formato JSON e invio al client
    header('Content-Type: application/json');
    echo json_encode($data);

    // Chiusura della connessione al database
    $conn->close();
}
