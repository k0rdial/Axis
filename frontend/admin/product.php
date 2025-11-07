<?php

session_start();

require_once __DIR__ . '/../../backend/admin/data.php';
require_once __DIR__ . '/../../backend/config.php';

if (!isset($_SESSION['username'])) {
    header("Location: /axis.com/");
    exit();
}

if (!isset($_GET['id'])) {
    die("Product not found.");
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM products WHERE id = $id");

if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

$navLocation = $_SESSION['active-nav'] ?? '';

switch ($navLocation) {
    case 'men':
        $goto = "/axis.com/admin/men";
        break;
    case 'women':
        $goto = "/axis.com/admin/women";
        break;
    default:
        $goto = "/axis.com/admin/home";
}

$message = [
    'msg' => $_SESSION['cart-message'] ?? '',
    'status' => $_SESSION['cart-status'] ?? '',
    'error' => $_SESSION['cart-error'] ?? ''
];

function showMessage($msg) {
    return !empty($msg) ? "<p class='cart-msg'>$msg</p>" : '';
}

function showStatus($msg) {
    return !empty($msg) ? "<p class='cart-status'>$msg</p>" : '';
}

function showError($msg) {
    return !empty($msg) ? "<p class='cart-error'>$msg</p>" : '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axis</title>

    <link rel="icon" href="/axis.com/assets/img/favicon.ico">
    <link rel="stylesheet" href="/axis.com/assets/css/user/product.css">
    <link rel="stylesheet" href="/axis.com/assets/css/user/header.css">
</head>
<body>
    <?php include 'header.php';?> 

    <div class="main-content">
        <div class="back-button">
            <a href="<?= $goto; ?>" title="Go Back">
                <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#333">
                    <path d="M480-120 160-440l320-320 43 43-247 247h524v60H276l247 247-43 43Z"/>
                </svg>
                <span>back</span>
            </a>
        </div>

        <div class="status">
            <?= showMessage($message['msg']);
                unset($_SESSION['cart-message']);
            ?>
            <?= showStatus($message['status']);
                unset($_SESSION['cart-status']);
            ?>
            <?= showError($message['error']);
                unset($_SESSION['cart-error']);
            ?>
        </div>

        <div class="product-container">
            <div class="product-image">
                <img src="/axis.com/assets/uploads/<?= htmlspecialchars($product['image']); ?>" alt="<?= htmlspecialchars($product['name']); ?>">
            </div>

            <div class="product-details">
                <h1><?= htmlspecialchars($product['name']); ?></h1>
                <p class="price">P <?= number_format($product['price'], 2); ?></p>
            </div>

            <div class="div-wrap">
                <div class="sizes">
                    <label>size:</label>
                    <div class="size-options">
                        <?php if ($product['small'] > 0): ?><button type="button">S</button><?php endif; ?>
                        <?php if ($product['medium'] > 0): ?><button type="button">M</button><?php endif; ?>
                        <?php if ($product['large'] > 0): ?><button type="button">L</button><?php endif; ?>
                        <?php if ($product['extra_large'] > 0): ?><button type="button">XL</button><?php endif; ?>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <script src="/axis.com/assets/js/header.js"></script>
    <script src="/axis.com/assets/js/size.js"></script>

</body>
</html>