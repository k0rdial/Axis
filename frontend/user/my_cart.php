<?php

require_once __DIR__ . '/../../backend/user/data.php';

$user_id = $_SESSION['id'];

$query = "
    SELECT 
    c.id AS cart_id, c.size, p.*
    FROM carts c
    INNER JOIN products p ON c.product_id = p.id
    WHERE c.user_id = '$user_id'
";
$result = $conn->query($query);

?>

<section class="my-cart">

    <h1>my cart</h1>

    <?php if ($result && $result->num_rows > 0): ?>
        <div class="cart-items">
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="cart-item">
                    <img src="/axis.com/assets/uploads/<?= htmlspecialchars($row['image']); ?>" alt="<?= htmlspecialchars($row['name']); ?>">

                    <div class="cart-details">
                        <div class="cart-info">
                            <h2><?= htmlspecialchars($row['name']); ?></h2>
                            <p class="price">P <?= number_format($row['price'], 2); ?></p>
                        </div>

                        <div class="cart-actions">
                             <form action="/axis.com/backend/user/update_size.php" method="POST" class="update-size-form">
                                <input type="hidden" name="cart_id" value="<?= $row['cart_id']; ?>">
                                <input type="hidden" name="product_id" value="<?= $row['id']; ?>">

                                <label for="size_<?= $row['cart_id']; ?>">SIZE:</label>
                                <select name="size" id="size_<?= $row['cart_id']; ?>" onchange="this.form.submit()">
                                    <option value="S" <?= $row['size'] === 'S' ? 'selected' : '' ?><?= $row['small'] <= 0 ? 'disabled' : '' ?>>S</option>
                                    <option value="M" <?= $row['size'] === 'M' ? 'selected' : '' ?><?= $row['medium'] <= 0 ? 'disabled' : '' ?>>M</option>
                                    <option value="L" <?= $row['size'] === 'L' ? 'selected' : '' ?><?= $row['large'] <= 0 ? 'disabled' : '' ?>>L</option>
                                    <option value="XL" <?= $row['size'] === 'XL' ? 'selected' : '' ?><?= $row['extra_large'] <= 0 ? 'disabled' : '' ?>>XL</option>
                                </select>
                            </form>

                            <form action="/axis.com/backend/user/remove_cart.php" method="POST">
                                <input type="hidden" name="cart_id" value="<?= $row['cart_id']; ?>">
                                <button type="submit" class="remove-btn">remove</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>

        <div class="checkout">
            <a href="/axis.com/address=check" class="checkout-btn">proceed to checkout</a>
        </div>
    <?php else: ?>
        <p class="empty-cart">Your cart is empty.</p>
    <?php endif; ?>

</section>