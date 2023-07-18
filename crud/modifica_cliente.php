<?php
include '../config.php';

$id = $_POST['id'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];

$sql = "UPDATE az_clienti
SET nome_cliente =  '$nome', cognome_cliente = '$cognome', telefono_cliente = '$telefono',
 email_cliente = '$email'
WHERE id_cliente = $id;";
// die($sql);
if ($conn->query($sql) === TRUE) {
    header("Location: ../clienti.php");
} else {
    echo "Errore durante l'inserimento dell'animale: " . $conn->error;
}
