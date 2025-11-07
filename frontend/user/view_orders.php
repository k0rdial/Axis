<?php

if (isset($_GET['status'])) {
    $_SESSION['order_status'] = $_GET['status'];
} elseif (!isset($_SESSION['order_status'])) {
    $_SESSION['order_status'] = 'all';
}

function getOrderSection() {
    $status = $_SESSION['order_status'] ?? 'all';

    switch ($status) {
        case 'pending':
            return __DIR__ . '/orders_pending.php';
        case 'to_ship':
            return __DIR__ . '/orders_to_ship.php';
        case 'to_receive':
            return __DIR__ . '/orders_to_receive.php';
        case 'completed':
            return __DIR__ . '/orders_completed.php';
        case 'cancelled':
            return __DIR__ . '/orders_cancelled.php';
        default:
            return __DIR__ . '/orders_all.php';
    }
}

include 'orders_navigation.php';
?>

<section class="orders-container">

    <div class="orders-main">
        <?php include getOrderSection(); ?>
    </div>

</section>