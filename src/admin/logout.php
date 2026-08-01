<?php


$ROOT = '../../';
include_once("admin_header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

if (isset($_SESSION['ad'])) {
    session_unset();
}
echo '<script>window.location.replace("index.php");</script>';

echo '</div>';
include_once("footer.php");
?>