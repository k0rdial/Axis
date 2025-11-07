<?php
session_start();
require_once 'config.php';


if (!isset($_POST['order_id'], $_POST['new_status'])) {
    $_SESSION['order-error'] = "Invalid request.";
    header("Location: /axis.com/admin/cart?section=order&status=all");
    exit();
}

$order_id = intval($_POST['order_id']);
$new_status = strtolower(trim($_POST['new_status']));
$allowed_statuses = ['pending', 'to_ship', 'to_receive', 'completed', 'cancelled'];

if (!in_array($new_status, $allowed_statuses)) {
    $_SESSION['order-error'] = "Invalid status update.";
    header("Location: /axis.com/admin/cart?section=order");
    exit();
}

$update = $conn->prepare("UPDATE orders SET status = ? WHERE id = ?");
$update->bind_param("si", $new_status, $order_id);

if ($update->execute()) {
    $_SESSION['order-success'] = "order #$order_id updated to " . $new_status . ".";
} else {
    $_SESSION['order-error'] = "Failed to update order status.";
}

header("Location: /axis.com/admin/cart?section=order&status=$new_status");
exit();
?>
