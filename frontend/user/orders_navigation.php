<div class="orders-navigation">
    <ul>
        <li><a href="?section=orders&status=all" class="<?= ($_SESSION['order_status'] ?? 'all') === 'all' ? 'active' : '' ?>">ALL</a></li>
        <li><a href="?section=orders&status=pending" class="<?= ($_SESSION['order_status'] ?? '') === 'pending' ? 'active' : '' ?>">PENDING</a></li>
        <li><a href="?section=orders&status=to_ship" class="<?= ($_SESSION['order_status'] ?? '') === 'to_ship' ? 'active' : '' ?>">TO SHIP</a></li>
        <li><a href="?section=orders&status=to_receive" class="<?= ($_SESSION['order_status'] ?? '') === 'to_receive' ? 'active' : '' ?>">TO RECEIVE</a></li>
        <li><a href="?section=orders&status=completed" class="<?= ($_SESSION['order_status'] ?? '') === 'completed' ? 'active' : '' ?>">COMPLETED</a></li>
        <li><a href="?section=orders&status=cancelled" class="<?= ($_SESSION['order_status'] ?? '') === 'cancelled' ? 'active' : '' ?>">CANCELLED</a></li>
    </ul>
</div>