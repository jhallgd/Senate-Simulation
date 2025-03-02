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
    $check = $da->delete_committee_bill($_POST["bl_id"], $_POST["co_id"]);
    if ($check) {
        echo "Successfully Removed. <a href ='/admin/'>Return Home</a>";
    }else{
        echo "Failed. <a href ='/admin/'>Return Home</a>";
    }

}

include_once($SUBROOT . "footer.php");
?>