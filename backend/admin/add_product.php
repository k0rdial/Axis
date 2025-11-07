<?php
session_start();
require_once 'config.php';

if (isset($_POST['add'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'] ?? '';
    $small = $_POST['small'] ?? 0;
    $medium = $_POST['medium'] ?? 0;
    $large = $_POST['large'] ?? 0;
    $extra_large = $_POST['extra_large'] ?? 0;

    $uploadDir = __DIR__ . '/../../assets/uploads/';
    $image = basename($_FILES['image']['name']);
    $uploadFile = $uploadDir . $image;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile)) {
        $stmt = $conn->prepare("INSERT INTO products (name, price, category, small, medium, large, extra_large, image) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sdssiiis", $name, $price, $category, $small, $medium, $large, $extra_large, $image);
        $stmt->execute();
        $_SESSION['add_status'] = "product added successfully!";
        header("Location: /axis.com/admin/cart?section=add");
        exit();
    } else {
        $_SESSION['add_error'] = "FAILED TO UPLOAD IMAGE";
        header("Location: /axis.com/admin/cart?section=add");
        exit();
    }
}
?>