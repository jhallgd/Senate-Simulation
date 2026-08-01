<?php


$ROOT = '../../';
include_once("admin_header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

$ad_name = -1;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['uname'], $_POST['pass'])) {
    $ad_name = $da->check_admin_login($_POST['uname'], $_POST['pass']);
}

if ($ad_name == -1) {
    echo '<script>window.location.replace("' . $base_href . 'admin/login_form.php");</script>';
} else {
    $_SESSION["ad"] = $ad_name;
    echo '<script>window.location.replace("' . $base_href . 'admin/");</script>';
}
echo '</div>';
include_once($ROOT . "/components/footer.php");
?>