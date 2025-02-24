<?php


$ROOT = '../../';
include_once($ROOT . "components/header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

if (isset($_SESSION['se'])) {
    session_unset();
}
echo 'You are now logged out. <a href="/">Return Home</a>';

echo '</div>';
include_once($ROOT . "/components/footer.php");
?>