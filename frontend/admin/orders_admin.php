<?php
require_once __DIR__ . '/../../backend/admin/data.php';

$status = $_GET['status'] ?? 'all';
$whereClause = $status !== 'all' ? "WHERE o.status = '$status'" : '';

$query = "
    SELECT 
        o.id AS order_id,
        o.status,
        o.created_at,
        o.total AS total_price,
        o.payment_status,
        o.payment_proof,
        o.payment_reference,
        u.firstname, u.lastname, u.email,
        a.province, a.city, a.barangay, a.street, a.postal
    FROM orders o
    JOIN users u ON o.user_id = u.id
    JOIN address a ON o.address_id = a.id
    $whereClause
    ORDER BY o.id DESC
";

$result = $conn->query($query);
?>

<div class='orders-list'>
<?php if ($result && $result->num_rows > 0): ?>
    <?php while ($order = $result->fetch_assoc()): ?>

        <div class="order-card">
            <div class="order-header">
                <p><strong>order #<?= $order['order_id'] ?></strong></p>
                <p><?= date("F j, Y", strtotime($order['created_at'])) ?></p>
                <span class="status <?= strtolower($order['status']) ?>">
                    <?= strtoupper($order['status']) ?>
                </span>
            </div>

            <div class="customer-info">
                <p><strong>customer:</strong> <?= $order['firstname'] . ' ' . $order['lastname'] ?></p>
                <p><strong>email:</strong> <?= $order['email'] ?></p>
                <p><strong>address:</strong>
                    <?= "{$order['street']}, {$order['barangay']}, {$order['city']}, {$order['province']} ({$order['postal']})" ?>
                </p>
            </div>

            <div class="order-items">
                <?php
                $items = $conn->query("
                    SELECT p.name, p.image, oi.size, oi.price
                    FROM order_items oi
                    JOIN products p ON oi.product_id = p.id
                    WHERE oi.order_id = '{$order['order_id']}'
                ");
                while ($item = $items->fetch_assoc()):
                ?>
                    <div class="order-item">
                        <img src="/axis.com/assets/uploads/<?= htmlspecialchars($item['image']) ?>" alt="">
                        <div>
                            <p><?= htmlspecialchars($item['name']) ?></p>
                            <p>size: <?= htmlspecialchars($item['size']) ?></p>
                            <p>p<?= number_format($item['price'], 2) ?></p>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="payment-info">
                <h4>PAYMENT DETAILS</h4>
                <div class="payment-details">
                    <div class="payment-row">
                        <span>payment status:</span>
                        <strong class="status-label <?= $order['payment_status'] ?? 'pending' ?>">
                            <?= $order['payment_status'] ?? 'pending' ?>
                        </strong>
                    </div>
                    
                    <?php if (!empty($order['payment_reference'])): ?>
                    <div class="payment-row">
                        <span>reference no:</span>
                        <strong><?= htmlspecialchars($order['payment_reference']) ?></strong>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (!empty($order['payment_proof'])): ?>
                    <div class="payment-row proof-row">
                        <span>proof of payment:</span>
                        <img src="/axis.com/assets/uploads/payments/<?= htmlspecialchars($order['payment_proof']) ?>" 
                         alt="Payment Proof" class="payment-proof">
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($order['payment_status'] === 'pending' && $order['status'] === 'pending'): ?>
                    <div class="payment-actions">
                        <form action="/axis.com/backend/admin/update_payment_status.php" method="POST" class="payment-actions">
                            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                            <button type="submit" name="action" value="approved" class="approve-btn">approve</button>
                            <button type="submit" name="action" value="rejected" class="reject-btn">reject</button>
                        </form>
                    </div>
                <?php endif; ?>
            </div>

            <div class="order-footer">
                <p><strong>total:</strong> p<?= number_format($order['total_price'], 2) ?></p>

                <?php if ($order['status'] === 'to_ship'): ?>
                    <form action="/axis.com/backend/admin/update_order_status.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <input type="hidden" name="new_status" value="to_receive">
                        <button class="update-btn">mark as to receive</button>
                    </form>
                <?php elseif ($order['status'] === 'to_receive'): ?>
                    <form action="/axis.com/backend/admin/update_order_status.php" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                        <input type="hidden" name="new_status" value="completed">
                        <button class="update-btn">mark as completed</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

    <?php endwhile; ?>
<?php else: ?>
    <p class="no-orders">No orders found.</p>
<?php endif; ?>
</div>
