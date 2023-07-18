<?php
$dbServerName = "mysql.next-data.net";
$dbUsername = "www_13237";
$dbPassword = "uBaKfYFM";
$dbName = "www_wpschool_it";

$conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
