<?php
include '../config.php';


// gestione
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // recuperare i dati del form
    $nome = $_POST['nomeCliente'];
    $cognome = $_POST['cognomeCliente'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];


    // validare i dati del form
    if (empty($nome) || empty($cognome) || empty($email)) {
        echo "Nome, cognome e email sono obbligatori";
    } else {
        if (empty($telefono)) {
            $sql = "INSERT INTO az_clienti (nome_cliente, cognome_cliente,  email_cliente) 
VALUES ('$nome', '$cognome', '$email')";
        } else {
            $sql = "INSERT INTO az_clienti (nome_cliente, cognome_cliente, telefono_cliente, email_cliente) 
VALUES ('$nome', '$cognome', '$telefono', '$email')";
        }

        if ($conn->query($sql) === TRUE) {
            $id = $conn->insert_id;
            // $response = $id;
            $response = $id;
        } else {
            $response = $conn->error;
        }
        echo json_encode(array('result' => $response));
    }
}

// chiudere la connessione al database
$conn->close();
