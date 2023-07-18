<?php
include '../config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id_cliente = $_POST['id_cliente'];
    $id_animale = $_POST['id_animale'];
    $data = $_POST['data'];
    $ora_inizio = $_POST['ora_inizio'];
    $referto = $_POST['referto'];

    $sql = "INSERT INTO az_visite (data_appuntamento, ora_appuntamento, referto_appuntamento, id_animale) 
    VALUES ('$data', '$ora_inizio', '$referto', '$id_animale')";

    if($conn->query($sql) === TRUE) {
        $id_visita = $conn->insert_id;
        // echo $id_visita;
        header("Location: ../visita-detail.php?id_visita=" . $id_visita);
    } else {
        $response = $conn->error;
    }

}