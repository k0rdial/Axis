<?php

session_start();
require_once 'config.php';

if (isset($_POST['search'])) {
    $email = $_POST['email'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");

    if ($result->num_rows > 0) {
        $_SESSION['email_status'] = 'EMAIL FOUND';
        $_SESSION['email_value'] = $email;
        header("Location: /axis.com/resetpassword");
        exit();
    } else {
        $_SESSION['email_status'] = 'EMAIL NOT FOUND';
        $_SESSION['email_value'] = $email;
        header("Location: /axis.com/forgotpassword");
        exit();
    }
    exit();
}

?>