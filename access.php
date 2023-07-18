<?php
include 'config.php';

$email = $_POST['user_name'];
$password = md5($_POST['password']);

$sql = "SELECT * FROM az_users WHERE email = '" . $email . "' AND password = '" . $password . "'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        session_start();
        $_SESSION['message'] = 'success';
        $_SESSION['username'] = $row["nome"];
        header("Location: https://wpschool.it/projectwork/zinga/");
    }
} else {
    session_start();
    $_SESSION['message'] = 'error';
    header("Location: https://wpschool.it/projectwork/zinga/");
}
