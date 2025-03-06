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
    $check = $da->update_bills_parties($_POST["pb_id"], $_POST["pvt_id"]);
    if ($check) {
        echo '<script>window.location.replace("/admin/bills_parties");</script>';
    }else{
        echo '<script>window.location.replace("/admin/bills_parties");</script>';
    }


}

include_once($SUBROOT . "footer.php");
?>