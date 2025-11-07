<?php

session_start();
require_once 'config.php';

if (!isset($_GET['id'])) {
    die("No product ID specified.");
}

$id = intval($_GET['id']);

$query = $conn->query("SELECT image FROM products WHERE id = $id");
if ($query->num_rows === 0) {
    die("Product not found.");
}

$product = $query->fetch_assoc();
$imagePath = __DIR__ . "/../../assets/uploads/" . $product['image'];

$delete = $conn->query("DELETE FROM products WHERE id = $id");

if ($delete) {

    if (file_exists($imagePath)) {
        unlink($imagePath);
    }

    $_SESSION['delete_status'] = "PRODUCT DELETED";



    header("Location: /axis.com/admin/cart");
    exit;
} else {
    die("Error deleting product: " . $conn->error);
}

?>