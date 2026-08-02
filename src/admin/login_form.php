<?php

include_once("admin_header.php");

$error_message = '';
$is_locked = false;

if (isset($_GET['error']) && $_GET['error'] === 'locked') {
	$is_locked = true;
	$minutes = isset($_GET['m']) ? (int) $_GET['m'] : 30;
	if ($minutes < 1) {
		$minutes = 1;
	}
	$error_message = 'Too many failed attempts. Try again in ' . $minutes . ' minute(s).';
} elseif (isset($_GET['error']) && $_GET['error'] === 'invalid') {
	$remaining = isset($_GET['r']) ? (int) $_GET['r'] : 0;
	if ($remaining < 0) {
		$remaining = 0;
	}
	$error_message = 'Invalid username or password. Remaining attempts: ' . $remaining . '.';
}

if ($error_message !== '') {
	echo '<p>' . htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') . '</p>';
}

 echo '<form action = "' . $base_href . 'admin/login.php" method="post">';
 echo '<p>Please login to continue.</p>';
 echo '<label for="uname">Username:</label><br>';
 echo '<input type="text" id="uname" name="uname"' . ($is_locked ? ' disabled' : '') . '><br>';
 echo '<label for="pass">Password:</label><br>';
 echo '<input type="password" id="pass" name="pass"' . ($is_locked ? ' disabled' : '') . '><br>';
 echo '<input type="submit" value="Login"' . ($is_locked ? ' disabled' : '') . '>';
 echo '</form>';

 include_once("footer.php");
?>