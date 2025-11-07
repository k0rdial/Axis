<?php

session_start();
require_once 'config.php';

$findStatus = $conn->query("SELECT * FROM users WHERE status ='online'");

if ($findStatus->num_rows > 0) {
    $result = $findStatus->fetch_assoc();
    $username = $result['username'];

    $conn->query("UPDATE users SET status = 'offline' WHERE username = '$username'");
    
    session_unset();
    session_destroy();

    header('Location: /axis.com/');
    exit();
}

?>