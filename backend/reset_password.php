<?php

session_start();
require_once 'config.php';

$email = $_SESSION['email_value'] ?? '';

if (isset($_POST['reset'])) {
    $newPass = $_POST['new-password'];
    $confPass = $_POST['confirm-password'];

    $result = $conn->query("SELECT * FROM users WHERE email = '$email'");
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        if ($newPass === $confPass) {
            $password = password_hash($newPass, PASSWORD_DEFAULT);

            $conn->query("UPDATE users 
                        SET password='$password' 
                        WHERE email = '$email'");
            header("Location: /axis.com/reset=success");
            exit();
        } else {
            $_SESSION['pass-error'] = "PASSWORDS DON'T MATCH";
            header("Location: /axis.com/resetpassword");
            exit();
        }

    }

    header("Location: /axis.com/resetpassword");
    exit();
}

?>