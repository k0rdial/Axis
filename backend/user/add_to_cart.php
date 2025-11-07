<?php

session_start();
require_once 'config.php';

$user_id = $_SESSION['id'];

if (isset($_POST['product_id'])) {
    $product_id = intval($_POST['product_id']);
    $size = $_POST['size'];

    $checkCart = $conn->query("SELECT * FROM carts WHERE user_id='$user_id'
                            AND product_id='$product_id'");
    
    if ($checkCart->num_rows > 0) {
        $_SESSION['cart-message'] = "product already in cart";
    } else {
        $insert = $conn->query("
            INSERT INTO carts (user_id, product_id, size)
            VALUES ('$user_id','$product_id','$size')
        ");

        if ($insert) {
            $_SESSION['cart-status'] = "product added to cart";
        } else {
            $_SESSION['cart-error'] = "add to cart error";
        }
    }

    header("Location: /axis.com/product?id=$product_id");
    exit();
} else {
    $_SESSION['cart-error'] = "invalid request";
    exit();
}

?>