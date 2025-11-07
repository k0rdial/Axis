<?php

session_start();

require_once __DIR__ . '/../../backend/user/data.php';

if (!isset($_SESSION['username'])) {
    header("Location: /axis.com/");
    exit();
}

$credentials = [
    'username' => $_SESSION['username'] ?? '',
    'email' => $_SESSION['email'] ?? '',
    'firstname' => $_SESSION['firstname'] ?? '',
    'lastname' => $_SESSION['lastname'] ?? '',
    'contact' => $_SESSION['contact'] ?? ''
];

$address = [
    'province' => $_SESSION['province'] ?? '',
    'city' => $_SESSION['city'] ?? '',
    'barangay' => $_SESSION['barangay'] ?? '',
    'postal' => $_SESSION['postal'] ?? '',
    'street' => $_SESSION['street'] ?? ''
];

$status = [
    'name' => $_SESSION['name-save'] ?? '',
    'address' => $_SESSION['address-save'] ?? '',
    'email' => $_SESSION['email-save'] ?? '',
    'contact' => $_SESSION['contact-save'] ?? '',
    'password' => $_SESSION['password-save'] ?? ''
];

$error = [
    'email' => $_SESSION['email-error'] ?? '',
    'contact' => $_SESSION['contact-error'] ?? '',
    'password' => $_SESSION['password-error'] ?? '',
    'checkout' => $_SESSION['checkout-error'] ?? ''
];

function showStatus($message) {
    return !empty($message) ? "<p class='status-message'>$message</p>" : '';
}

function showError($message) {
    return !empty($message) ? "<p class='error-message'>$message</p>" : '';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Axis</title>

    <link rel="icon" href="/axis.com/assets/img/favicon.ico">
    <link rel="stylesheet" href="/axis.com/assets/css/user/profile.css">
    <link rel="stylesheet" href="/axis.com/assets/css/user/header.css">
    <link rel="stylesheet" href="/axis.com/assets/css/user/footer.css">
</head>
<body>
    <?php include 'header.php';?>
    <div class="container">

        <div class="profile" id="profile-section">
            <form action="/axis.com/backend/user/profile.php" method="post">
                <div class="profile-input">
                    <h1>
                        PROFILE
                    </h1>
                </div>

                <div class="profile-input">
                    <label for="firstname">FIRST NAME:</label>
                    <input type="text" name="firstname" id="firstname" disabled
                    value="<?= $firstname ?>">
                    <a onclick="editName('firstname')">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </a>
                </div>

                <div class="profile-input">
                    <label for="lastname">LAST NAME:</label>
                    <input type="text" name="lastname" id="lastname" disabled
                    value="<?= $lastname ?>">
                    <a onclick="editName('lastname')">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </a>
                </div>

                <?= showStatus($status['name']); 
                unset($_SESSION['name-save']); ?>

                <div class="profile-input">
                    <button type="submit" id="save" name="save" disabled>
                        SAVE
                    </button>
                </div>
            </form>

        </div>

        <div class="address" id="address-section">
            <form action="/axis.com/backend/user/profile.php" method="post">
                <div class="address-input">
                    <h1>
                        ADDRESS
                    </h1>
                </div>

                <div class="form-box">

                    <div class="address-input">
                        <label for="province">PROVINCE:</label>
                        <input type="text" name="province" id="province" disabled
                        value="<?= $address['province']; ?>">
                    </div>

                    <div class="address-input">
                        <label for="city">CITY:</label>
                        <input type="text" name="city" id="city" disabled
                        value="<?= $address['city']; ?>">
                    </div>

                    <div class="address-input">
                        <label for="barangay">BARANGAY:</label>
                        <input type="text" name="barangay" id="barangay" disabled
                        value="<?= $address['barangay']; ?>">
                    </div>

                    <div class="address-input">
                        <label for="postal">POSTAL CODE:</label>
                        <input type="text" name="postal" id="postal" disabled
                        value="<?= $address['postal']; ?>">
                    </div>

                    <div class="address-input">
                        <label for="street">STREET NAME, BUILDING, HOUSE NO.:</label>
                        <input type="text" name="street" id="street" disabled
                        value="<?= $address['street']; ?>">
                    </div>
                </div> 

                <?= showStatus($status['address']);
                    unset($_SESSION['address-save']); ?>
                    
                <?= showError($error['checkout']);
                    unset($_SESSION['checkout-error']); ?>

                <div class="address-input address-button">
                    <button type="button" onclick="editAddress()" id="edit" name="edit">
                        EDIT
                    </button>

                    <button type="submit" id="address-save" name="address-save" disabled>
                        SAVE
                    </button>
                </div>   
            </form>
        </div>

        <div class="account" id="account-section">
            <div class="title account-title">
                <h1>ACCOUNT & INFORMATION</h1>
            </div>

            <form action="/axis.com/backend/user/profile.php" class="email-form" method="post">
                <div class="account-input">
                    <label for="email">EMAIL:</label>
                    <input type="email" name="email" id="email" disabled
                    value="<?= $credentials['email']; ?>">
                    <a onclick="editEmail()">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </a>
                </div>

                <?= showStatus($status['email']);
                    unset($_SESSION['email-save']); ?>

                <?= showError($error['email']);
                    unset($_SESSION['email-error']); ?>
                <div class="account-input email-button">
                    <button type="submit" id="email-save" name="email-save" disabled>
                        SAVE
                    </button>
                </div>
            </form>

            <form action="/axis.com/backend/user/profile.php" class="contact-form" method="post">
                <div class="account-input contact">
                    <label for="contact">CONTACT NUMBER:</label>
                    <input type="tel" maxlength="11" inputmode="numeric" name="contact" id="contact" disabled
                    value="<?= $credentials['contact']; ?>">
                    <a onclick="editContact()">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M200-200h57l391-391-57-57-391 391v57Zm-80 80v-170l528-527q12-11 26.5-17t30.5-6q16 0 31 6t26 18l55 56q12 11 17.5 26t5.5 30q0 16-5.5 30.5T817-647L290-120H120Zm640-584-56-56 56 56Zm-141 85-28-29 57 57-29-28Z"/></svg>
                    </a>
                </div>

                <?= showStatus($status['contact']);
                    unset($_SESSION['contact-save']); ?>

                <?= showError($error['contact']);
                    unset($_SESSION['contact-error']); ?>

                <div class="account-input contact-button">
                    <button type="submit" id="contact-save" name="contact-save" disabled>
                        SAVE
                    </button>
                </div>
            </form>

        </div>

        <div class="password" id="password-section">
            <div class="title password-title">
                <h1>CHANGE PASSWORD</h1>
            </div>

            <form action="/axis.com/backend/user/profile.php" class="password-form" method="post">
                <div class="account-input">
                    <label for="old-password">OLD PASSWORD:</label>
                    <input type="password" name="old-password" id="old-password">
                </div>

                <div class="account-input">
                    <label for="new-password">NEW PASSWORD:</label>
                    <input type="password" name="new-password" id="new-password">
                </div>

                <div class="account-input">
                    <label for="confirm-password">CONFIRM PASSWORD:</label>
                    <input type="password" name="confirm-password" id="confirm-password">
                </div>

                <?= showStatus($status['password']);
                    unset($_SESSION['password-save']); ?>

                <?= showError($error['password']);
                    unset($_SESSION['password-error']); ?>
                
                <div class="account-input">
                    <button type="submit" id="password-save" name="password-save" disabled>
                        CHANGE PASSWORD
                    </button>
                </div>
            </form>
        </div>

        <div class="footer">
            <button onclick="
                localStorage.setItem('activeNav', 'shop');
                window.location.href='/axis.com/backend/logout.php';
                ">
                LOGOUT
            </button>
        </div>

    </div>

    <script src="/axis.com/assets/js/header.js"></script>
    <script src="/axis.com/assets/js/profile.js"></script>
    
</body>
</html>