<?php
include '../config.php';

foreach($_POST as $key => $value) {
    echo $key . ' - ' . $value . '<br>';
}

$id = $_POST['id'];
$data = $_POST['data'];
$ora = $_POST['ora'];
$referto = $_POST['referto'];

$sql = "UPDATE az_visite
SET data_appuntamento =  '$data', ora_appuntamento = '$ora', referto_appuntamento = '$referto'
WHERE id_appuntamento = $id;";
// die($sql);
if ($conn->query($sql) === TRUE) {
    header("Location: ../visite.php");
} else {
    echo "Errore durante l'inserimento dell'animale: " . $conn->error;
}
