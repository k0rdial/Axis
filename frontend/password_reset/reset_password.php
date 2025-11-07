<?php

session_start();

$errors =[
    'pass' => $_SESSION['pass-error'] ?? ''
];

$emailValue = $_SESSION['email'] ?? '';

function showError($errors) {
    return !empty($errors) ? "<p class='show-error'>$errors</p>" : '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axis</title>

    <link rel="icon" href="/axis.com/assets/img/favicon.ico">
    <link rel="stylesheet" href="/axis.com/frontend/password_reset/css/reset_password.css">
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="/axis.com/assets/img/axis logo.png" alt="Axis Logo">
        </div>

        <div class="display">
            <h4>RESET PASSWORD</h4>
        </div>

        <div class="form-box">
            <form action="/axis.com/backend/reset_password.php" method="POST">

                <div class="input-group">
                    <input type="password" id="new-password" name="new-password" minlength="6" autocomplete="off" required>
                    <label for="new-password" class="floating-label">NEW PASSWORD</label>
                </div>

                <div class="input-group">
                    <input type="password" id="confirm-password" name="confirm-password" minlength="6" autocomplete="off" required>
                    <label for="confirm-password" class="floating-label">CONFIRM PASSWORD</label>
                    <?= showError($errors['pass']); ?>
                </div>

                <div class="input-group">
                    <button type="submit" id="reset" name="reset" disabled>
                        RESET PASSWORD
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="/axis.com/assets/js/reset_password.js"></script>
</body>
</html>