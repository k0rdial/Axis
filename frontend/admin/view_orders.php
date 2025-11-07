<?php

if (isset($_GET['status'])) {
    $_SESSION['order_status'] = $_GET['status'];
} elseif (!isset($_SESSION['order_status'])) {
    $_SESSION['order_status'] = 'all';
}

include 'orders_navigation.php';
?>

<section class="orders-container">
    <div class="orders-main">
        <?php include 'orders_admin.php'; ?>
    </div>

</section>