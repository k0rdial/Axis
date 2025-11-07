<?php
require_once __DIR__ . '/../../backend/user/data.php';
$user_id = $_SESSION['id'];

$query = "
    SELECT 
        o.id AS order_id, 
        o.status, 
        o.created_at, 
        o.total AS total_price,
        p.name, 
        p.image, 
        oi.size, 
        oi.price
    FROM orders o
    JOIN order_items oi ON o.id = oi.order_id
    JOIN products p ON oi.product_id = p.id
    WHERE o.user_id = '$user_id' AND o.status = 'to_receive'
    ORDER BY o.created_at DESC
";
$result = $conn->query($query);
?>

<div class="orders-list">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="order-card">
                <div class="order-header">
                    <p><?= date("F j, Y", strtotime($row['created_at'])); ?></p>
                    <span class="status <?= strtolower($row['status']); ?>">
                        <?= htmlspecialchars(strtoupper($row['status'])); ?>
                    </span>
                </div>
                <div class="order-body">
                    <img src="/axis.com/assets/uploads/<?= htmlspecialchars($row['image']); ?>" 
                         alt="<?= htmlspecialchars($row['name']); ?>">
                    <div class="info">
                        <h3><?= htmlspecialchars($row['name']); ?></h3>
                        <p>size: <?= htmlspecialchars($row['size']); ?></p>
                        <p>p<?= number_format($row['price'], 2); ?></p>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="no-orders">no to receive orders found.</p>
    <?php endif; ?>
</div>
