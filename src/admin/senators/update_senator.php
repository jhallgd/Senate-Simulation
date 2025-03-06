<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header.php");

if (!isset($_SESSION['ad'])) {

    echo '<form action = "login.php" method="post">';
    echo '<p>Please login to continue.</p>';
    echo '<label for="uname">Username:</label><br>';
    echo '<input type="text" id="uname" name="uname"><br>';
    echo '<label for="pass">Password:</label><br>';
    echo '<input type="password" id="pass" name="pass"><br>';
    echo '<input type="submit" value="Login">';
    echo '</form>';
} else {
    list($party_id, $party_name) = explode("%", $_POST['se_pa_id'], 2);
    $data = [
        "se_id" => $_POST["se_id"],
        "se_first_name" => $_POST["se_first_name"],
        "se_last_name" => $_POST["se_last_name"],
        "se_title" => $_POST["se_title"],
        "se_pa_id" => (int) $party_id,
        "pa_name" => $party_name
    ];
    $senator = new senators($data);
    if ($senator->get_id() == -1) {
        $check = $da->create_senator($senator);
    } else {
        $check = $da->update_senator($senator);
    }
    if ($check) {
        echo '<script>window.location.replace("/admin/senators");</script>';
    }else{
        echo '<script>window.location.replace("/admin/senators");</script>';
    }

}

include_once($SUBROOT . "footer.php");
?>