<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['id'])) {
    header("Location: /axis.com/");
    exit();
}

$user_id = $_SESSION['id'];
$order_id = intval($_POST['order_id'] ?? 0);

if ($order_id <= 0) {
    $_SESSION['cart-error'] = "Invalid order ID.";
        header("Location: /axis.com/cart?section=orders&status=pending");
    exit();
}

$check = $conn->query("
    SELECT * FROM orders 
    WHERE id = '$order_id' AND user_id = '$user_id' AND status = 'pending'
");

if ($check->num_rows === 0) {
    $_SESSION['cart-error'] = "You can only cancel pending orders.";
    header("Location: /axis.com/cart?section=orders&status=pending");
    exit();
}

$conn->query("
    UPDATE orders 
    SET status = 'cancelled' 
    WHERE id = '$order_id' AND user_id = '$user_id'
");

$_SESSION['cart-status'] = "Order cancelled successfully.";
header("Location: /axis.com/cart?section=orders&status=pending");
exit();
?>
