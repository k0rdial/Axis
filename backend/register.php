<?php

session_start();
require_once 'config.php';

if (isset($_POST['register'])) {
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirm-password'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $role = 'user';

    $checkEmail = $conn->query("SELECT email FROM users WHERE email =  '$email'");
    if ($checkEmail->num_rows > 0) {
        $_SESSION['email_error'] = 'EMAIL IS ALREADY REGISTERED.';

        $_SESSION['firstname'] = $firstname;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['username'] = $username;
    } else {
        $checkUsername = $conn->query("SELECT username FROM users WHERE username =  '$username'");

        if ($checkUsername->num_rows > 0) {
            $_SESSION['username_error'] = 'USERNAME IS ALREADY TAKEN.';

            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['email'] = $email;
        } else {
            if ($password === $confirmpassword) {
                $encrypted_password = password_hash($password, PASSWORD_DEFAULT);

                $conn->query("INSERT INTO users (email,
                                                username,
                                                password,
                                                firstname,
                                                lastname,
                                                role) VALUES ('$email',
                                                '$username',
                                                '$encrypted_password',
                                                '$firstname',
                                                '$lastname',
                                                '$role')");
                header("Location: /axis.com/register=success");
                exit();
            } else {

                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['username'] = $username;
                $_SESSION['email'] = $email;

                $_SESSION['password_error'] = "PASSWORDS DON'T MATCH.";
                header("Location: /axis.com/registration");
                exit();
            }
        }
    }

    header("Location: /axis.com/registration");
    exit();
}

?>