<?php

require_once __DIR__ . '/../../backend/config.php';

$result = $conn->query("SELECT * FROM products ORDER BY id ASC");

$status = [
    'update' => $_SESSION['update_status'] ?? '',
    'delete' => $_SESSION['delete_status'] ?? ''
];

function showUpdate($message) {
    return !empty($message) ? "<div class='update-message'><p>$message</p></div>" : '';
}

function showDelete($message) {
    return !empty($message) ? "<div class='delete-message'><p>$message</p></div>" : '';
}

?>

<section class="view">

    <?= showUpdate($status['update']); 
    unset($_SESSION['update_status']); ?>
    <?= showDelete($status['delete']); 
    unset($_SESSION['delete_status']); ?>
    
    <table>

        <thead class="title">
            <th>image</th>
            <th>name</th>
            <th>price</th>
            <th>category</th>
            <th>small</th>
            <th>medium</th>
            <th>large</th>
            <th>extra large</th>
            <th>action</th>
        </thead>

        <tbody class="display">
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td>
                        <img src="/axis.com/assets/uploads/<?= $row['image']; ?>" 
                            alt="
                            <?= $row['image']; ?>" width="150">
                    </td>
                    <td><?= $row['name']; ?></td>
                    <td>₱<?= number_format($row['price'], 2); ?></td>
                    <td><?= $row['category']; ?></td>
                    <td><?= $row['small']; ?></td>
                    <td><?= $row['medium']; ?></td>
                    <td><?= $row['large']; ?></td>
                    <td><?= $row['extra_large']; ?></td>

                    <td class="action">
                        <a href="/axis.com/admin/edit_product?id=<?= $row['id']; ?>" title="Edit">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px" fill="#000000ff">
                                    <path d="M200-200h57l391-391-57-57-391 391v57Zm600-584L784-784q-17-17-40-17t-40 17L648-728l112 112 56-56q17-17 17-40t-17-40ZM160-120v-170l528-528q25-25 60.5-25t60.5 25l56 56q25 25 25 60.5T865-641L337-113H160Z"/>
                                </svg>
                            </a>

                            <a href="/axis.com/backend/admin/delete_product.php?id=<?= $row['id']; ?>" 
                               onclick="return confirm('Are you sure you want to delete this product?')" title="Delete">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px" fill="#ff1100ff">
                                    <path d="M261-120q-24 0-42-18t-18-42v-600h-81v-60h186v-30q0-24 18-42t42-18h186q24 0 42 18t18 42v30h186v60h-81v600q0 24-18 42t-42 18H261Zm438-660H261v600h438v-600ZM390-240h60v-360h-60v360Zm120 0h60v-360h-60v360Z"/>
                                </svg>
                            </a>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="9" style="text-align:center;">NO PRODUCTS FOUND.</td>
                </tr>
            <?php endif; ?> 
        </tbody>

    </table>

</section>