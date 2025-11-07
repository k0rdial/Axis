<?php

session_start();

$status = $_SESSION['email_status'] ?? '';
$emailValue = $_SESSION['email_value'] ?? '';

session_unset();

function showStatus($status) {
    return "<p class='show-message'>$status</p>";
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axis</title>

    <link rel="icon" href="/axis.com/assets/img/favicon.ico">
    <link rel="stylesheet" href="/axis.com/frontend/password_reset/css/forgot_password.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="/axis.com/assets/img/axis logo.png" alt="Axis Logo">
        </div>

        <div class="display">
            <h4>FORGOT PASSWORD</h4>
        </div>

        <div class="form-box">
            <form action="/axis.com/backend/forgot_password.php" method="POST">
                <div class="input-group">
                    <input type="email" name="email" id="email" autocomplete="email" required value='<?= htmlspecialchars($emailValue) ?>'>
                    <label for="email" class="floating-label">EMAIL</label>
                    <?= showStatus($status); ?>
                </div>
                
                <div class="input-group">
                    <button type="submit" id="search" name="search" disabled>
                        SEARCH EMAIL
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="/axis.com/assets/js/forgot_password.js"></script>
</body>
</html>