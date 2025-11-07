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
    WHERE o.user_id = '$user_id'
    ORDER BY o.id DESC
";
$result = $conn->query($query);

$orders = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $orders[$row['order_id']]['details'] = [
            'status' => $row['status'],
            'created_at' => $row['created_at'],
            'total_price' => $row['total_price']
        ];
        $orders[$row['order_id']]['items'][] = [
            'name' => $row['name'],
            'image' => $row['image'],
            'size' => $row['size'],
            'price' => $row['price']
        ];
    }
}
?>

<div class="orders-list">
    <?php if (!empty($orders)): ?>
        <?php foreach ($orders as $order_id => $order): ?>
            <div class="order-card">
                <div class="order-header">
                    <p><?= date("F j, Y", strtotime($order['details']['created_at'])); ?></p>
                    <span class="status <?= strtolower($order['details']['status']); ?>">
                        <?= htmlspecialchars(strtoupper($order['details']['status'])); ?>
                    </span>
                </div>

                <div class="order-items">
                    <?php foreach ($order['items'] as $item): ?>
                        <div class="order-body">
                            <img src="/axis.com/assets/uploads/<?= htmlspecialchars($item['image']); ?>" 
                                alt="<?= htmlspecialchars($item['name']); ?>">
                            <div class="info">
                                <h3><?= htmlspecialchars($item['name']); ?></h3>
                                <p>size: <?= htmlspecialchars($item['size']); ?></p>
                                <p>P<?= number_format($item['price'], 2); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="order-footer">
                    <p><strong>total:</strong> P<?= number_format($order['details']['total_price'], 2); ?></p>

                    <?php if (strtolower($order['details']['status']) === 'pending'): ?>
                        <form action="/axis.com/backend/user/cancel_order.php" method="POST" onsubmit="return confirm('Cancel this order?');">
                            <input type="hidden" name="order_id" value="<?= $order_id; ?>">
                            <button type="submit" class="cancel-btn">cancel</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p class="no-orders">no orders found.</p>
    <?php endif; ?>
</div>
