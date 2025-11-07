<?php

require_once 'config.php';

$findStatus = $conn->query("SELECT * FROM users WHERE status ='online'");

if ($findStatus->num_rows > 0) {
    $result = $findStatus->fetch_assoc();

    $id = $result['id'];
    $username = $result['username'];
    $email = $result['email'];
    $firstname = $result['firstname'];
    $lastname = $result['lastname'];
    $contact = $result['contact'];

    $findAddress = $conn->query("SELECT * FROM address WHERE user_id='$id'");
    if ($findAddress->num_rows > 0) {
        $resultAddress = $findAddress->fetch_assoc();

        $region = $resultAddress['region'];
        $province = $resultAddress['province'];
        $city = $resultAddress['city'];
        $barangay = $resultAddress['barangay'];
        $postal = $resultAddress['postal'];
        $street = $resultAddress['street'];

        $_SESSION['region'] = $region;
        $_SESSION['province'] = $province;
        $_SESSION['city'] = $city;
        $_SESSION['barangay'] = $barangay;
        $_SESSION['postal'] = $postal;
        $_SESSION['street'] = $street;
    }

    $_SESSION['id'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
    $_SESSION['firstname'] = $firstname;
    $_SESSION['lastname'] = $lastname;
    $_SESSION['contact'] = $contact;

} else {
    if (realpath(__FILE__) === realpath($_SERVER['SCRIPT_NAME'])) {
        header("Location: /axis.com/");
        exit();
    }
}

?>