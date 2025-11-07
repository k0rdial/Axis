<?php

session_start();

require_once __DIR__ . '/../backend/check_online.php';

$errors = [
    'email' => $_SESSION['email_error'] ?? '',
    'pass' => $_SESSION['password_error'] ?? '',
    'user' => $_SESSION['username_error'] ?? ''
];

$credentials = [
    'firstname' => $_SESSION['firstname'] ?? '',
    'lastname' => $_SESSION['lastname'] ?? '',
    'email' => $_SESSION['email'] ?? '',
    'username' => $_SESSION['username'] ?? ''
];

session_unset();

function showError($error) {
    return !empty($error) ? "<p class='error-message'>$error</p>" : '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axis</title>

    <link rel="icon" href="/axis.com/assets/img/favicon.ico">
    <link rel="stylesheet" href="/axis.com/assets/css/register.css">
</head>
<body>
    <div class="container">
        <form action="/axis.com/backend/register.php" method="POST">
            <div>
                <img src="/axis.com/assets/img/axis logo.png" alt="Axis Logo">
            </div>

            <div class="name-group">
                <div class="input-group">
                    <input type="text" name="firstname" id="firstname" autocomplete="off" required
                    value="<?= htmlspecialchars($credentials['firstname']) ?>">
                    <label for="firstname" class="floating-label">FIRST NAME</label>
                </div>

                <div class="input-group">
                    <input type="text" name="lastname" id="lastname" autocomplete="off" required
                    value="<?= htmlspecialchars($credentials['lastname']) ?>">
                    <label for="lastname" class="floating-label">LAST NAME</label>
                </div>
            </div>

            <div class="input-group">
                <input type="email" name="email" id="email" autocomplete="email" required
                value="<?= htmlspecialchars($credentials['email']) ?>">
                <label for="email" class="floating-label">EMAIL</label>
            </div>

            <div class="input-group">
                <input type="text" name="username" id="username" autocomplete="username" required
                value="<?= htmlspecialchars($credentials['username']) ?>">
                <label for="username" class="floating-label">USERNAME</label>
            </div>

            <div class="password-group error">
                <div class="input-group">
                    <input type="password" id="password" name="password" minlength="6" autocomplete="off" required>
                    <label for="password" class="floating-label">PASSWORD</label>
                </div>

                <div class="input-group">
                    <input type="password" id="confirm-password" name="confirm-password" minlength="6" autocomplete="off" required>
                    <label for="confirm-password" class="floating-label">CONFIRM PASSWORD</label>
                </div>
            </div>

            <div class="register-error">
                <?= showError($errors['pass']); ?>
                <?= showError($errors['email']); ?>
                <?= showError($errors['user']); ?>
            </div>
            
            <div class="input-group">
                <button type="submit" id="register" name="register" disabled>REGISTER</button>
            </div>

            <div class="input-group hasAccount">
                <p>
                    ALREADY HAVE AN ACCOUNT?
                    <a href="/axis.com/login">LOG IN HERE.</a>
                </p>
            </div>

        </form>
    </div>

    <script src="/axis.com/assets/js/register.js"></script>
</body>
</html>