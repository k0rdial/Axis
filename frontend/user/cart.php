<?php

session_start();

require_once __DIR__ . '/../../backend/user/data.php';

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
            return __DIR__ . '/my_cart.php';
        case 'orders':
            return __DIR__ . '/view_orders.php';
        default:
            return __DIR__ . '/my_cart.php';
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
    <link rel="stylesheet" href="/axis.com/assets/css/user/cart.css">
    <link rel="stylesheet" href="/axis.com/assets/css/user/my_cart.css">
    <link rel="stylesheet" href="/axis.com/assets/css/user/orders_navigation.css">
    <link rel="stylesheet" href="/axis.com/assets/css/user/view_orders.css">
    <link rel="stylesheet" href="/axis.com/assets/css/user/header.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="container">

        <div class="navigation">
            <ul class="ul">
                <li class="li">
                    <a href="?section=view" class="<?= ($_SESSION['section'] ?? 'view') === 'view' ? 'active' : '' ?>">MY CART</a>
                </li>

                <li class="li">
                    <a href="?section=orders" class="<?= ($_SESSION['section'] ?? '') === 'orders' ? 'active' : '' ?>">MY ORDERS</a>
                </li>
            </ul>
        </div>
        
        <div class="main-content">
            <?php include getSection(); ?>
        </div>

    </div>

    <script src="/axis.com/assets/js/header.js"></script>
    
</body>
</html>