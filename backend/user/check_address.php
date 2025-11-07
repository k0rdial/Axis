<?php
session_start();
require_once 'config.php';

$user_id = $_SESSION['id'];

$result = $conn->query("SELECT * FROM address WHERE user_id = '$user_id'");

if ($result->num_rows > 0) {
    header("Location: /axis.com/checkout");
    exit();
} else {
    $_SESSION['checkout-error'] = "PLEASE SET UP YOUR ADDRESS FIRST BEFORE CHECKING OUT";
    header("Location: /axis.com/profile#address-section");
    exit();
}
?>