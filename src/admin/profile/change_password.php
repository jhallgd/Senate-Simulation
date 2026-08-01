<?php
$SUBROOT = "../";
include_once($SUBROOT. "admin_header_profile.php");

$admin = $da->get_admin_by_id($_SESSION['ad']);
$error_text = '';
if (isset($_POST['og_pass'])) {
    $check = check_form();
    if (!$check[0]) {
        $error_text = $check[1];
    }else{
        echo '<script>window.location.replace("' . $base_href . 'admin/");</script>';
    }
}

function check_form(): array
{
    global $admin;
    global $da;
    $error_text = '';
    $pass = true;
    if ($_POST['new_pass'] == null or $_POST['test_pass'] == null) {
        $pass = false;
        $error_text = "Missing key fields.";
        return [$pass, $error_text];
    }
    if ($_POST['new_pass'] != $_POST['test_pass']) {
        $pass = false;
        $error_text = "New passwords do not match.";
        return [$pass, $error_text];
    }

    if (strlen($_POST['new_pass']) < 6) {
        $pass = false;
        $error_text = "New passwords must be at least 6 characters long.";
        return [$pass, $error_text];
    }
    if ($da->check_admin_login($admin->get_username(), $_POST['og_pass']) != $admin->get_id()) {
        $pass = false;
        $error_text = "You have entered the wrong password.";
        return [$pass, $error_text];
    }
    if (!$da->update_admin($admin, $_POST['new_pass'])){
        $pass = false;
        $error_text = "An error has occured";
        return [$pass, $error_text];
    }
    return [$pass, $error_text];
}

echo "<a href ='admin/'>Return Home</a>";
echo '<h1>Change Password</h1>';


echo '<form action = "" method="post">';
echo '<label for="og_pass">Origional Password:</label><br>';
echo '<input type="password" id="og_pass" name="og_pass"><br>';
echo '<label for="new_pass">New Password:</label><br>';
echo '<input type="password" id="new_pass" name="new_pass"><br>';
echo '<label for="test_pass">Retype new Password:</label><br>';
echo '<input type="password" id="test_pass" name="test_pass"><br>';
echo '<input type="submit" value="Change">';
echo '</form>';
echo $error_text;




include_once($SUBROOT . "footer.php");
?>