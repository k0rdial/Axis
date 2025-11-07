<?php
session_start();
require_once 'config.php';

if (!isset($_POST['order_id'], $_POST['action'])) {
    $_SESSION['order-error'] = "Invalid payment update request.";
    header("Location: /axis.com/admin/cart?section=order");
    exit();
}

$order_id = intval($_POST['order_id']);
$action = strtolower(trim($_POST['action']));

$validActions = ['approved', 'rejected'];
if (!in_array($action, $validActions)) {
    $_SESSION['order-error'] = "Invalid payment action.";
    header("Location: /axis.com/admin/cart?section=order");
    exit();
}

$payment_status = ucfirst($action);

if ($action === 'approved') {
    $items = $conn->query("
        SELECT oi.product_id, oi.size, p.small, p.medium, p.large, p.extra_large
        FROM order_items oi
        JOIN products p ON oi.product_id = p.id
        WHERE oi.order_id = '$order_id'
    ");

    $insufficientStock = false;
    $outOfStockItems = [];

    while ($item = $items->fetch_assoc()) {
        $size = $item['size'];
        $product_id = $item['product_id'];

        switch ($size) {
            case 'S': $sizeColumn = 'small'; break;
            case 'M': $sizeColumn = 'medium'; break;
            case 'L': $sizeColumn = 'large'; break;
            case 'XL': $sizeColumn = 'extra_large'; break;
            default: $sizeColumn = ''; break;
        }

        if ($sizeColumn === '') continue;

        if ($item[$sizeColumn] <= 0) {
            $insufficientStock = true;
            $outOfStockItems[] = "#$product_id ($size)";
        }
    }

    if ($insufficientStock) {
        $_SESSION['order-error'] = "cannot approve order #$order_id. out of stock for: " . implode(', ', $outOfStockItems);
        header("Location: /axis.com/admin/cart?section=orders&status=pending");
        exit();
    }

    $items->data_seek(0); // rewind result pointer
    while ($item = $items->fetch_assoc()) {
        $size = $item['size'];
        $product_id = $item['product_id'];

        switch ($size) {
            case 'S': $sizeColumn = 'small'; break;
            case 'M': $sizeColumn = 'medium'; break;
            case 'L': $sizeColumn = 'large'; break;
            case 'XL': $sizeColumn = 'extra_large'; break;
        }

        $conn->query("
            UPDATE products 
            SET $sizeColumn = $sizeColumn - 1 
            WHERE id = '$product_id' AND $sizeColumn > 0
        ");
    }

    $conn->query("
        UPDATE orders 
        SET payment_status = 'approved', status = 'to_ship'
        WHERE id = '$order_id'
    ");

    $_SESSION['order-success'] = "payment for order #$order_id approved and marked as 'to ship'.";
    header("Location: /axis.com/admin/cart?section=order&status=to_ship");
    exit();
} else {
    $conn->query("
        UPDATE orders 
        SET payment_status = 'rejected', status = 'cancelled'
        WHERE id = '$order_id'
    ");
    $_SESSION['order-success'] = "payment for order #$order_id has been rejected.";
    header("Location: /axis.com/admin/cart?section=order&status=cancelled");
    exit();
}

header("Location: /axis.com/admin/cart?section=order&status=all");
exit();
?>
