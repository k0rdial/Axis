<?php

session_start();
require_once 'config.php';

if (isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']);
    $user_id = $_SESSION['id'];

    $check = $conn->prepare("SELECT id FROM carts WHERE id = ? AND user_id = ?");
    $check->bind_param("ii", $cart_id, $user_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        
        $delete = $conn->prepare("DELETE FROM carts WHERE id = ?");
        $delete->bind_param("i", $cart_id);
        $delete->execute();
        $delete->close();

        $_SESSION['cart_status'] = "Item removed successfully!";
    } else {
        $_SESSION['cart_status'] = "Invalid action.";
    }

    $check->close();
}

header("Location: /axis.com/cart");
exit();

?>