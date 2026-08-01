<?php

include_once("admin_header.php");

if (!isset($_SESSION['ad'])) {
    echo '<script>window.location.replace("' . $base_href . 'admin/login_form.php");</script>';
}

echo "<a href ='" . $base_href . "admin/'>Return Home</a>";

?>