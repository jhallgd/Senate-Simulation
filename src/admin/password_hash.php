<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

$password_hash = '';
$error_text = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['plain_password']) || $_POST['plain_password'] === '') {
        $error_text = 'Please enter a password.';
    } else {
        $password_hash = password_hash($_POST['plain_password'], PASSWORD_DEFAULT);
    }
}

echo '<h1>Password Hash Generator</h1>';
echo '<p>Enter a password below to generate a bcrypt hash for the Admins table.</p>';

echo '<form action="' . $base_href . 'admin/password_hash.php" method="post">';
echo '<label for="plain_password">Password:</label><br>';
echo '<input type="password" id="plain_password" name="plain_password" required><br><br>';
echo '<input type="submit" value="Generate Hash">';
echo '</form><br>';

if ($error_text !== '') {
    echo '<p>' . htmlspecialchars($error_text, ENT_QUOTES, 'UTF-8') . '</p>';
}

if ($password_hash !== '') {
    echo '<label for="password_hash">Generated Hash:</label><br>';
    echo '<textarea id="password_hash" rows="4" cols="95" readonly>' . htmlspecialchars($password_hash, ENT_QUOTES, 'UTF-8') . '</textarea>';
}

include_once($SUBROOT . "footer.php");
?>