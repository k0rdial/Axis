<?php

session_start();

require_once __DIR__ . '/../../backend/user/data.php';

if (!isset($_SESSION['username'])) {
    header("Location: /axis.com/");
    exit();
}

$_SESSION['active-nav'] = '';

unset($_SESSION['saved']);

$credentials = [
    'firstname' => $_SESSION['firstname'] ?? '',
    'lastname' => $_SESSION['lastname'] ?? '',
    'email' => $_SESSION['email'] ?? '',
    'username' => $_SESSION['username'] ?? ''
];

$products = $conn->query("SELECT * FROM products ORDER BY id ASC");
$men = $conn->query("SELECT * FROM products WHERE category='men' ORDER BY id ASC");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axis</title>

    <link rel="icon" href="/axis.com/assets/img/favicon.ico">
    <link rel="stylesheet" href="/axis.com/assets/css/user/home.css">
    <link rel="stylesheet" href="/axis.com/assets/css/user/header.css">
</head>
<body>
    <?php include 'header.php';?> 

    <div class="main-content">
        <div class="all-section" id="all-section">
            <div class="title">
                <h1>
                    SHOP
                </h1>
            </div>

            <div class="product-carousel">
                <div class="product-track">
                    <?php if ($products && $products->num_rows > 0): ?>
                        <?php while ($row = $products->fetch_assoc()): ?>
                            <a href="/axis.com/product?id=<?= htmlspecialchars($row['id']); ?>" class="product-link">
                                <div class="product-card">
                                    <img src="/axis.com/assets/uploads/<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>">
                                    <p class="product-name"><?= htmlspecialchars($row['name']); ?></p>
                                    <p class="product-price">p <?= number_format($row['price'], 2); ?></p>
                                </div>
                            </a>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <p class="no-products">No products available.</p>
                    <?php endif; ?>
                </div>
            </div>
        
            <div class="scroll">
                <a href="#display-product">view more</a>
            </div>
        </div>
        
        <div class="display-product" id="display-product">
            <?php 
                $products2 = $conn->query("SELECT * FROM products ORDER BY id ASC");
                if ($products2 && $products2->num_rows > 0):
                    while ($row = $products2->fetch_assoc()):
            ?>
                <a href="/axis.com/product?id=<?= htmlspecialchars($row['id']); ?>" class="product-link">
                    <div class="product-card">
                        <img src="/axis.com/assets/uploads/<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>">
                        <h3><?= htmlspecialchars($row['name']); ?></h3>
                        <p>P <?= number_format($row['price'], 2); ?></p>
                    </div>
                </a>
            <?php
                endwhile;
            else:
                echo "<p class='no-products'>NO PRODUCTS AVAILABE</p>";
            endif;
            ?>
        </div>

    </div>
    
    <script src="/axis.com/assets/js/header.js"></script>
    
</body>
</html>