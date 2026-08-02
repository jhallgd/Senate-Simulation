<?php


$ROOT = '../../';
include_once("admin_header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

$max_login_attempts = 5;
$lockout_seconds = 1800;

if (!isset($_SESSION['admin_login_attempts'])) {
    $_SESSION['admin_login_attempts'] = 0;
}

if (isset($_SESSION['admin_login_locked_until']) && time() < $_SESSION['admin_login_locked_until']) {
    $remaining_minutes = (int) ceil(($_SESSION['admin_login_locked_until'] - time()) / 60);
    echo '<script>window.location.replace("' . $base_href . 'admin/login_form.php?error=locked&m=' . $remaining_minutes . '");</script>';
    echo '</div>';
    include_once($ROOT . "/components/footer.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['uname'], $_POST['pass'])) {
    echo '<script>window.location.replace("' . $base_href . 'admin/login_form.php");</script>';
    echo '</div>';
    include_once($ROOT . "/components/footer.php");
    exit;
}

$ad_name = $da->check_admin_login($_POST['uname'], $_POST['pass']);

if ($ad_name == -1) {
    $_SESSION['admin_login_attempts'] += 1;

    if ($_SESSION['admin_login_attempts'] >= $max_login_attempts) {
        $_SESSION['admin_login_locked_until'] = time() + $lockout_seconds;
        $remaining_minutes = (int) ceil($lockout_seconds / 60);
        echo '<script>window.location.replace("' . $base_href . 'admin/login_form.php?error=locked&m=' . $remaining_minutes . '");</script>';
    } else {
        $remaining_attempts = $max_login_attempts - $_SESSION['admin_login_attempts'];
        echo '<script>window.location.replace("' . $base_href . 'admin/login_form.php?error=invalid&r=' . $remaining_attempts . '");</script>';
    }
} else {
    $_SESSION['admin_login_attempts'] = 0;
    unset($_SESSION['admin_login_locked_until']);
    $_SESSION["ad"] = $ad_name;
    echo '<script>window.location.replace("' . $base_href . 'admin/");</script>';
}
echo '</div>';
include_once($ROOT . "/components/footer.php");
?>