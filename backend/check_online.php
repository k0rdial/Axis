<?php

require_once 'config.php';

$findStatus = $conn->query("SELECT * FROM users WHERE status ='online'");

if ($findStatus->num_rows > 0) {
    $result = $findStatus->fetch_assoc();

    $username = $result['username'];
    $email = $result['email'];
    $firstname = $result['firstname'];
    $lastname = $result['lastname'];
    $role = $result['role'];

    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;

    if ($role === 'admin') {
        header("Location: /axis.com/admin/home");
        exit();
    } else {
        header("Location: /axis.com/home");
        exit();
    }

} else {
    if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_NAME'])) {
        header("Location: /axis.com/");
        exit();
    }
}

?>