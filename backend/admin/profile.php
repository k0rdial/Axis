<?php

session_start();
require_once 'config.php';

$id = $_SESSION['id'];

if (isset($_POST['save'])) {
    $firstname = $_POST['firstname'] ?? '';
    $lastname = $_POST['lastname'] ?? '';

    $result = $conn->query("SELECT * FROM users WHERE status='online'");

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();

        $email = $user['email'];

        if (!empty($firstname) && empty($lastname)) {
            $conn->query("UPDATE users
                SET firstname='$firstname'
                WHERE email='$email'");

            header("Location: /axis.com/profile=admin");
            $_SESSION['name-save'] = "FIRST NAME UPDATED";
            exit();
        } else if (!empty($lastname) && empty($firstname)) {
            $conn->query("UPDATE users
                SET lastname='$lastname'
                WHERE email='$email'");

            header("Location: /axis.com/profile=admin");
            $_SESSION['name-save'] = "LAST NAME UPDATED";
            exit();
        } else {
            $conn->query("UPDATE users
                SET firstname='$firstname',
                lastname='$lastname'
                WHERE email='$email'");

            header("Location: /axis.com/profile=admin");
            $_SESSION['name-save'] = "FULL NAME UPDATED";
            exit();
        }
    }

    header("Location: /axis.com/profile=admin");
    exit();
}

if (isset($_POST['address-save'])) {
    $province = $_POST['province'] ?? '';
    $city = $_POST['city'] ?? '';
    $barangay = $_POST['barangay'] ?? '';
    $postal = $_POST['postal'] ?? '';
    $street = $_POST['street'] ?? '';

    $resultAddress = $conn->query("SELECT * FROM address WHERE user_id='$id'");

    if ($resultAddress->num_rows > 0) {
        $address = $resultAddress->fetch_assoc();

        $conn->query("UPDATE address
        SET province='$province',
        city='$city',
        barangay='$barangay',
        postal='$postal',
        street='$street'
        WHERE user_id='$id'");

        header("Location: /axis.com/profile=admin#address-section");
        $_SESSION['address-save'] = "ADDRESS UPDATED";
        exit();
    } else {
        $conn->query("INSERT INTO address (
                        user_id,
                        province,
                        city,
                        barangay,
                        postal,
                        street) VALUES (
                        '$id',
                        '$province',
                        '$city',
                        '$barangay',
                        '$postal',
                        '$street')");
        
        header("Location: /axis.com/profile=admin#address-section");
        $_SESSION['address-save'] = "ADDRESS ADDED";
        exit();
    }
}

if (isset($_POST['email-save'])) {
    $email = $_POST['email'];

    $resultEmail = $conn->query("SELECT email FROM users WHERE email='$email'");

    if ($resultEmail->num_rows > 0) {

        $_SESSION['email-error'] = "EMAIL ALREADY TAKEN";

        header("Location: /axis.com/profile=admin#account-section");
        exit();
    } else {
        $conn->query("UPDATE users
                    SET email='$email'
                    WHERE id='$id'");
        $_SESSION['email-save'] = "EMAIL UPDATED";
        header("Location: /axis.com/profile=admin#account-section");
        exit();
    }
}

if (isset($_POST['contact-save'])) {
    $contact = $_POST['contact'];

    $resultContact = $conn->query("SELECT contact FROM users WHERE id='$id'");
    $checkContact = $conn->query("SELECT contact FROM users WHERE contact='$contact'");

    if ($checkContact->num_rows > 0) {
        $_SESSION['contact-error'] = "CONTACT NUMBER ALREADY TAKEN";

        header("Location: /axis.com/profile=admin#account-section");
        exit();
    } else {
        if ($resultContact->num_rows > 0) {
            $conn->query("UPDATE users
                    SET contact='$contact'
                    WHERE id='$id'");
            $_SESSION['contact-save'] = "CONTACT NUMBER UPDATED";
            header("Location: /axis.com/profile=admin#account-section");
            exit();
        } else {
            $conn->query("UPDATE users
                    SET contact='$contact'
                    WHERE id='$id'");
            $_SESSION['contact-save'] = "CONTACT NUMBER ADDED";
            header("Location: /axis.com/profile=admin#account-section");
            exit();
        }
    }
}

if (isset($_POST['password-save'])) {
    $oldpass = $_POST['old-password'];
    $newpass = $_POST['new-password'];
    $confirmpass = $_POST['confirm-password'];

    $resultPassword = $conn->query("SELECT password FROM users WHERE id='$id'");

    if ($resultPassword->num_rows > 0) {
        $getPass = $resultPassword->fetch_assoc();

        if (password_verify($oldpass, $getPass['password'])) {
            if ($newpass === $confirmpass) {
                $password = password_hash($newpass, PASSWORD_DEFAULT);
                $conn->query("UPDATE users 
                        SET password='$password' 
                        WHERE id = '$id'");

                $_SESSION['password-save'] = "PASSWORD UPDATED";
                header("Location: /axis.com/profile#password-section");
                exit();
            } else {
                $_SESSION['password-error'] = "PASSWORDS DON'T MATCH";
                header("Location: /axis.com/profile#password-section");
                exit();
            }
        } else {
            $_SESSION['password-error'] = "OLD PASSWORD DON'T MATCH";
            header("Location: /axis.com/profile#password-section");
            exit();
        }
    }
}

header("Location: /axis.com/home/profile=admin");
exit();

?>