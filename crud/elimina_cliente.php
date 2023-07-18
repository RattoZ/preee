<?php
include '../config.php';

// gestione
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // recuperare i dati del form
    $id = $_POST['id_cliente'];

    // validare i dati del form
    if (empty($id)) {
        echo "C'è qualcosa che non va..";
    } else {
        $sql = "DELETE FROM az_clienti WHERE id_cliente =" . $id . " ;";

        if ($conn->query($sql) === TRUE) {
            echo '1';
            $response = 'success';
        } else {
            $response = "Errore durante l'inserimento del cliente: " . $conn->error;
        }
        echo json_encode(array('result' => $response));
    }
}

// chiudere la connessione al database
$conn->close();
