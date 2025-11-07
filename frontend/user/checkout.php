<?php

session_start();
require_once __DIR__ . '/../../backend/user/data.php';
require_once __DIR__ . '/../../backend/config.php';

if (!isset($_SESSION['id'])) {
    header("Location: /axis.com/");
    exit();
}

$user_id = $_SESSION['id'];

$addressQuery = $conn->query("SELECT * FROM address WHERE user_id = '$user_id'");
$address = $addressQuery->fetch_assoc();

$cartQuery = $conn->query("
    SELECT c.id AS cart_id, c.size, p.*
    FROM carts c
    INNER JOIN products p ON c.product_id = p.id
    WHERE c.user_id = '$user_id'
");

$total = 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axis</title>

    <link rel="icon" href="/axis.com/assets/img/favicon.ico">
    <link rel="stylesheet" href="/axis.com/assets/css/user/checkout.css">
    <link rel="stylesheet" href="/axis.com/assets/css/user/header.css">
</head>
<body>
    <?php include 'header.php';?>
    
    <div class="main-content">
        <div class="back-button">
            <a href="/axis.com/cart" title="Go Back">
                <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#333">
                    <path d="M480-120 160-440l320-320 43 43-247 247h524v60H276l247 247-43 43Z"/>
                </svg>
                <span>back</span>
            </a>
        </div>

        <div class="checkout-container">

            <div class="cart-summary">
                <h2>order summary</h2>

                <div class="item-scroll">
                    <?php if ($cartQuery->num_rows > 0): ?>
                        <?php while ($item = $cartQuery->fetch_assoc()): 
                            $total += $item['price'];
                        ?>
                            <div class="cart-item">
                                <img src="/axis.com/assets/uploads/<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>">
                                <div class="item-details">
                                    <h3><?= htmlspecialchars($item['name']); ?></h3>
                                    <p>size: <?= htmlspecialchars($item['size']); ?></p>
                                    <p>p<?= number_format($item['price'], 2); ?></p>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="empty">your cart is empty</p>
                    <?php endif; ?>
                </div>

                <div class="total">
                    <h3>total:</h3>
                    <p>P<?= number_format($total, 2); ?></p>
                </div>

                <div class="address-section">
                    <h2>shipping address</h2>
                    <?php if ($address): ?>
                        <div class="address-box">
                            <p><?= htmlspecialchars($address['street']); ?></p>
                            <p><?= htmlspecialchars($address['barangay']); ?>, <?= htmlspecialchars($address['city']); ?></p>
                            <p><?= htmlspecialchars($address['province']); ?> <?= htmlspecialchars($address['postal']); ?></p>
                        </div>
                    <?php else: ?>
                        <p class="no-address">
                            no address found.
                            <a href="/axis.com/home/profile#address-section">Set up address</a>
                        </p>
                    <?php endif; ?>
                </div>

                <!-- <form action="/axis.com/backend/user/checkout.php" method="POST">
                    <button type="submit" class="checkout-btn" <?= !$address ? 'disabled' : '' ?>>Place Order</button>
                </form> -->
            </div>

            <div class="checkout-details">
                <form action="/axis.com/backend/user/checkout.php" method="POST" enctype="multipart/form-data" class="checkout-form">
                    <h2>PAYMENT SECTION</h2>
                    <p>please transfer the total amount to our bank account:</p>
                    <div class="bank-details">
                        <p><strong>bank:</strong> BDO</p>
                        <p><strong>account name:</strong> AXIS CLOTHING</p>
                        <p><strong>account number:</strong> 1234-5678-9012</p>
                    </div>

                    <label for="proof">upload payment receipt (required):</label>
                    <input type="file" name="proof" id="proof" accept="image/*" required>

                    <label for="reference">reference number:</label>
                    <input type="text" maxlength="6" name="reference" id="reference" placeholder="enter last 6 digits">

                    <button type="submit" id="checkout-btn" class="checkout-btn" <?= !$address ? 'disabled' : '' ?>disabled>submit order</button>
                </form>
            </div>
        </div>
    </div>

    <script src="/axis.com/assets/js/header.js"></script>
    <script src="/axis.com/assets/js/checkout.js"></script>

</body>
</html>