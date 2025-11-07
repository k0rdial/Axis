<?php

session_start();

require_once __DIR__ . '/../../backend/admin/data.php';

if (!isset($_SESSION['username'])) {
    header("Location: /axis.com/");
    exit();
} else {
    if (!isset($_GET['id'])) {
        die("Product ID not provided.");
    }
}

$id = intval($_GET['id']);
$result = $conn->query("SELECT * FROM products WHERE id = $id");

$_SESSION['product_id'] = $id;

if ($result->num_rows === 0) {
    die("Product not found.");
}

$product = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axis</title>

    <link rel="icon" href="/axis.com/assets/img/favicon.ico">
    <link rel="stylesheet" href="/axis.com/assets/css/admin/edit_product.css">
</head>
<body>
    <div class="container">

        <div class="back-button">
            <a href="/axis.com/admin/cart" title="Go Back">
                <svg xmlns="http://www.w3.org/2000/svg" height="28px" viewBox="0 -960 960 960" width="28px" fill="#333">
                    <path d="M480-120 160-440l320-320 43 43-247 247h524v60H276l247 247-43 43Z"/>
                </svg>
                <span>back</span>
            </a>
        </div>

        <h1>EDIT PRODUCT</h1>

        <form action="/axis.com/backend/admin/edit_product.php" method="POST" enctype="multipart/form-data">
            <table class="edit-table">
                <thead>
                    <tr>
                        <th>name</th>
                        <th>price (₱)</th>
                        <th>category</th>
                        <th>small</th>
                        <th>medium</th>
                        <th>large</th>
                        <th>extra large</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td><input type="text" name="name" value="<?= htmlspecialchars($product['name']); ?>" required></td>
                        <td><input type="number" step="0.01" name="price" value="<?= htmlspecialchars($product['price']); ?>" required></td>
                        <td><input type="text" name="category" value="<?= htmlspecialchars($product['category']); ?>"></td>
                        <td><input type="number" name="small" value="<?= htmlspecialchars($product['small']); ?>"></td>
                        <td><input type="number" name="medium" value="<?= htmlspecialchars($product['medium']); ?>"></td>
                        <td><input type="number" name="large" value="<?= htmlspecialchars($product['large']); ?>"></td>
                        <td><input type="number" name="extra_large" value="<?= htmlspecialchars($product['extra_large']); ?>"></td>
                    </tr>
                </tbody>
            </table>

            <div class="image-section">
                <h3>current image</h3>
                <img src="/axis.com/assets/uploads/<?= htmlspecialchars($product['image']); ?>" alt="Current Product Image">
                
                <div class="file-input">
                    <label for="image">change image</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>
            </div>

            <div class="action">
                <button type="submit" name="update">UPDATE</button>
            </div>
        </form>
    
    </div>
</body>
</html>