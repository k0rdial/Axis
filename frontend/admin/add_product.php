<?php

require_once __DIR__ . '/../../backend/admin/data.php';

if (!isset($_SESSION['username'])) {
    header("Location: /axis.com/");
    exit();
}

$status = [
    'add' => $_SESSION['add_status'] ?? ''
];

$error = [
    'add' => $_SESSION['add_error'] ?? ''
];

function showAdd($message) {
    return !empty($message) ? "<div class='add-message'><p>$message</p></div>" : '';
}

function showError($message) {
    return !empty($message) ? "<div class='error-message'><p>$message</p></div>" : '';
}

?>

<?= showAdd($status['add']); 
    unset($_SESSION['add_status']); ?>
    <?= showError($error['add']); 
    unset($_SESSION['add_error']);
?>

<section class="add-product">
    <h1>ADD PRODUCT</h1>

    <div class="preview-box" id="preview-box">
        <span>NO IMAGE</span>
    </div>

    <form class="add-form" action="/axis.com/backend/admin/add_product.php" method="POST" enctype="multipart/form-data">
        <div class="input-group">
            <label for="image">SELECT IMAGE</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>

        <div class="input-group">
            <label for="name">PRODUCT NAME</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="input-group">
            <label for="price">PRICE</label>
            <input type="number" step="0.01" id="price" name="price" required>
        </div>

        <div class="input-group">
            <label for="category">CATEGORY</label>
            <input type="text" id="category" name="category">
        </div>

        <div class="input-group">
            <label for="small">SMALL</label>
            <input type="number" id="small" name="small">
        </div>

        <div class="input-group">
            <label for="medium">MEDIUM</label>
            <input type="number" id="medium" name="medium">
        </div>

        <div class="input-group">
            <label for="large">LARGE</label>
            <input type="number" id="large" name="large">
        </div>

        <div class="input-group">
            <label for="extra_large">EXTRA LARGE</label>
            <input type="number" id="extra_large" name="extra_large">
        </div>

        <button type="submit" name="add" class="add-btn">ADD PRODUCT</button>
    </form>
</section>