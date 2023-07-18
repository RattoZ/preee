<?php
include '../config.php';

$id_animale = $_POST['id'];
$nome = $_POST['nome_animale'];
$specie_animale = $_POST['specie_animale'];
$razza_animale = $_POST['razza_animale'];
$nascita = $_POST['nascita'];
$id_cliente = $_POST['id_cliente'];

$sql = "UPDATE az_animali
SET nome_animale =  '$nome', specie_animale = '$specie_animale', razza_animale = '$razza_animale',
 data_nascita_animale = '$nascita', id_cliente = '$id_cliente'
WHERE id_animale = $id_animale;";
// die($sql);
if ($conn->query($sql) === TRUE) {
    header("Location: ../animali.php");
} else {
    echo "Errore durante l'inserimento dell'animale: " . $conn->error;
}
