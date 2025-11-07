<?php
session_start();
require_once 'config.php';

if (!isset($_SESSION['id'])) {
    header("Location: /axis.com/");
    exit();
}

$user_id = $_SESSION['id'];

$addressQuery = $conn->query("SELECT * FROM address WHERE user_id = '$user_id'");
if ($addressQuery->num_rows === 0) {
    $_SESSION['cart-error'] = "Please set up your address before checkout.";
    header("Location: /axis.com/user/cart.php?section=view");
    exit();
}
$address = $addressQuery->fetch_assoc();
$address_id = $address['id'];

$cartQuery = $conn->query("
    SELECT c.*, p.price, p.small, p.medium, p.large, p.extra_large
    FROM carts c
    INNER JOIN products p ON c.product_id = p.id
    WHERE c.user_id = '$user_id'
");

if ($cartQuery->num_rows === 0) {
    $_SESSION['cart-error'] = "your cart is empty.";
    header("Location: /axis.com/cart?section=view");
    exit();
}

$total = 0;
$cartItems = [];
while ($item = $cartQuery->fetch_assoc()) {
    $total += $item['price'];
    $cartItems[] = $item;
}

$payment_proof = null;
$payment_reference = isset($_POST['reference']) ? trim($_POST['reference']) : '';

if (isset($_FILES['proof']) && $_FILES['proof']['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__ . '/../../assets/uploads/payments/';
    if (!file_exists($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    $fileTmpPath = $_FILES['proof']['tmp_name'];
    $fileName = time() . '_' . basename($_FILES['proof']['name']);
    $destination = $uploadDir . $fileName;

    if (move_uploaded_file($fileTmpPath, $destination)) {
        $payment_proof = $fileName;
    } else {
        $_SESSION['cart-error'] = "Failed to upload payment receipt. Please try again.";
        header("Location: /axis.com/user/checkout");
        exit();
    }
} else {
    $_SESSION['cart-error'] = "Payment proof is required.";
    header("Location: /axis.com/user/checkout");
    exit();
}

$conn->query("
    INSERT INTO orders (user_id, total, address_id, status, payment_proof, payment_reference, created_at)
    VALUES ('$user_id', '$total', '$address_id', 'Pending', '$payment_proof', '$payment_reference', NOW())
");

$order_id = $conn->insert_id;

foreach ($cartItems as $item) {
    $product_id = $item['product_id'];
    $size = $item['size'];
    $price = $item['price'];

    $conn->query("
        INSERT INTO order_items (order_id, product_id, size, price)
        VALUES ('$order_id', '$product_id', '$size', '$price')
    ");

    $sizeColumn = '';
    switch ($size) {
        case 'S': $sizeColumn = 'small'; break;
        case 'M': $sizeColumn = 'medium'; break;
        case 'L': $sizeColumn = 'large'; break;
        case 'XL': $sizeColumn = 'extra_large'; break;
    }

    if ($sizeColumn !== '') {
        $conn->query("
            UPDATE products 
            SET $sizeColumn = $sizeColumn - 1 
            WHERE id = '$product_id' AND $sizeColumn > 0
        ");
    }
}

$conn->query("DELETE FROM carts WHERE user_id = '$user_id'");

$_SESSION['cart-status'] = "Order placed successfully!";
header("Location: /axis.com/cart?section=orders&status=pending");
exit();

?>
