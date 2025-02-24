<?php


$ROOT = '../../';
include_once("admin_header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

if (isset($_SESSION['ad'])) {
    session_unset();
}
echo 'You are now logged out. <a href="/">Return Home</a>';

echo '</div>';
include_once("footer.php");
?>