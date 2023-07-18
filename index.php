<?php
require_once('./liblayout.php');
include 'config.php';
$title = 'index';
?>

<form method="get" action="./crud/get_clienti.php">
    <input name="id_cliente" value="">
    <button type="submit">Cliccami</button>
</form>