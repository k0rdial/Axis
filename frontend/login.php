<?php

session_start();

require_once __DIR__ . '/../backend/check_online.php';

$errors = [
    'login-error' => $_SESSION['login_error'] ?? ''
];

$usernameValue = $_SESSION['username'] ?? '';

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
    <link rel="stylesheet" href="/axis.com/assets/css/login.css">
</head>
<body>
    <div class="container">
        <form action="/axis.com/backend/login.php" method="POST">
            <div>
                <img src="/axis.com/assets/img/axis logo.png" alt="Axis Logo">
            </div>
            

            <div class="input-group">
                <input type="text" name="username" id="username" required value="<?= htmlspecialchars($usernameValue) ?>">
                <label for="username" class="floating-label">USERNAME</label>
            </div>
            
            <div class="input-group">
                <input type="password" id="password" name="password" required>
                <label for="password" class="floating-label">PASSWORD</label>

                <div class="login-error">
                    <?= showError($errors['login-error']); ?>
                </div>

                <div class="forgot-pass">
                    <label for="forgot">
                        <a href="/axis.com/forgotpassword">FORGOT YOUR PASSWORD?</a>
                    </label>
                </div>
            </div>
            
            <div class="input-group">
                <button type="submit" id="login" name="login" disabled>LOGIN</button>
            </div>

            <div class="input-group">
                <div class="label-register">
                    <label for="register">
                        DON'T HAVE AN ACCOUNT? 
                        <a href="/axis.com/registration">SIGN UP HERE.</a>
                    </label>
                </div>
            </div>
        </form>
    </div>

    <script src="/axis.com/assets/js/login.js"></script>
</body>
</html>