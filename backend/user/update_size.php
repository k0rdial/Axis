<?php

session_start();
require_once 'config.php';

if (isset($_POST['cart_id'], $_POST['size'], $_POST['product_id'])) {
    $cart_id = intval($_POST['cart_id']);
    $product_id = intval($_POST['product_id']);
    $size = $_POST['size'];

    $allowed_sizes = ['S', 'M', 'L', 'XL'];

    if (in_array($size, $allowed_sizes)) {

        $column = match($size) {
            'S' => 'small',
            'M' => 'medium',
            'L' => 'large',
            'XL' => 'extra_large',
        };

        $result = $conn->query("SELECT $column FROM products WHERE id = '$product_id'");
        $stock = $result->fetch_assoc()[$column] ?? 0;

        if ($stock > 0) {
            $stmt = $conn->prepare("UPDATE carts SET size = ? WHERE id = ?");
            $stmt->bind_param("si", $size, $cart_id);
            $stmt->execute();
            $stmt->close();

            $_SESSION['size-status'] = "size updated successfully!";
        } else {
            $_SESSION['size-status'] = "sorry, that size is out of stock.";
        }
    }
}

header("Location: /axis.com/cart?section=view");
exit();

?>