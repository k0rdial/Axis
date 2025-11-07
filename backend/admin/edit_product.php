<?php

session_start();
require_once 'config.php';

$id = $_SESSION['product_id'];

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $small = $_POST['small'];
    $medium = $_POST['medium'];
    $large = $_POST['large'];
    $extra_large = $_POST['extra_large'];
    $image = $product['image'];

    $query = $conn->query("SELECT image FROM products WHERE id='$id'");
    $row = $query->fetch_assoc();
    $image = $row['image'];

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = __DIR__ . '/../../assets/uploads/';
        $image = basename($_FILES['image']['name']);
        $uploadFile = $uploadDir . $image;
        move_uploaded_file($_FILES['image']['tmp_name'], $uploadFile);
    }

    $conn->query("
        UPDATE products SET
            name='$name',
            price='$price',
            category='$category',
            small='$small',
            medium='$medium',
            large='$large',
            extra_large='$extra_large',
            image='$image'
        WHERE id='$id'
    ");

    $_SESSION['update_status'] = "PRODUCT UPDATED";
    header("Location: /axis.com/admin/cart");
    exit();

} else {
    header("Location: /axis.com/admin/cart");
    exit();
}

?>