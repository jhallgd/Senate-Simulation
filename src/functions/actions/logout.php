<?php


$ROOT = '../../';
include_once($ROOT . "components/header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

if (isset($_SESSION['se'])) {
    session_unset();
}
echo '<script>window.location.replace("index.php");</script>';
echo '</div>';
include_once($ROOT . "/components/footer.php");
?>