<?php

include_once("admin_header.php");

if (!isset($_SESSION['ad'])) {
    echo '<script>window.location.replace("/admin/login_form.php");</script>';
}

echo "<a href ='/admin/'>Return Home</a>";

?>