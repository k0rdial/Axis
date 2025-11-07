<?php

session_start();

require_once __DIR__ . '/../../backend/admin/data.php';

if (!isset($_SESSION['username'])) {
    header("Location: /axis.com/");
    exit();
}

if (isset($_GET['section'])) {
    $_SESSION['section'] = $_GET['section'];
}

function getSection() {
    $section = $_SESSION['section'] ?? 'view';

    switch ($section) {
        case 'view':
            return __DIR__ . '/products.php';
        case 'add':
            return __DIR__ . '/add_product.php';
        case 'order':
            return __DIR__ . '/view_orders.php';
        default:
            return __DIR__ . '/products.php';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axis</title>

    <link rel="icon" href="/axis.com/assets/img/favicon.ico">
    <link rel="stylesheet" href="/axis.com/assets/css/admin/cart.css">
    <link rel="stylesheet" href="/axis.com/assets/css/admin/products.css">
    <link rel="stylesheet" href="/axis.com/assets/css/admin/add_product.css">
    <link rel="stylesheet" href="/axis.com/assets/css/admin/orders_navigation.css">
    <link rel="stylesheet" href="/axis.com/assets/css/admin/view_order.css">
    <link rel="stylesheet" href="/axis.com/assets/css/admin/orders_admin.css">
    <link rel="stylesheet" href="/axis.com/assets/css/admin/header.css">
</head>
<body>
    <?php if (isset($_SESSION['order-success']) || isset($_SESSION['order-error'])): ?>
            <div id="toast" class="<?= isset($_SESSION['order-success']) ? 'toast-success' : 'toast-error' ?>">
                <?= $_SESSION['order-success'] ?? $_SESSION['order-error'] ?>
            </div>
    <?php 
            unset($_SESSION['order-success'], $_SESSION['order-error']);
    endif; 
    ?>
    <?php include 'header.php';?>
    <div class="container">

        <div class="navigation">
            <ul class="ul">
                <li class="li">
                    <a href="?section=view" class="<?= ($_SESSION['section'] ?? 'view') === 'view' ? 'active' : '' ?>">VIEW PRODUCTS</a>
                </li>

                <li class="li">
                    <a href="?section=add" class="<?= ($_SESSION['section'] ?? '') === 'add' ? 'active' : '' ?>">ADD PRODUCTS</a>
                </li>

                <li class="li">
                    <a href="?section=order" class="<?= ($_SESSION['section'] ?? '') === 'order' ? 'active' : '' ?>">VIEW ORDERS</a>
                </li>
            </ul>
        </div>
        
        <div class="main-content">
            <?php include getSection(); ?>
        </div>

    </div>

    <script src="/axis.com/assets/js/header.js"></script>
    <script src="/axis.com/assets/js/products.js"></script>






    <script>
    document.addEventListener("DOMContentLoaded", () => {
        const toast = document.getElementById("toast");
        if (toast) {
            setTimeout(() => {
                toast.style.display = "none";
            }, 4000);
        }
    });
    </script>

    
</body>
</html>