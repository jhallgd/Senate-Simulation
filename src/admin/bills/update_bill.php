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
    $data = [
        "bl_id" => $_POST["bl_id"],
        "bl_title" => $_POST["bl_title"],
        "bl_short_text" => $_POST["bl_short_text"],
        "bl_url" => $_POST["bl_url"]
    ];
    $bill = new bills($data);
    if ($bill->get_bill_id() == -1) {
        $check = $da->create_bill($bill);
    } else {
        $check = $da->update_bill($bill);
    }
    if ($check) {
        echo "Update Success. <a href ='/admin/'>Return Home</a>";
    }else{
        echo "Update failed. <a href ='/admin/'>Return Home</a>";
    }

}

include_once($SUBROOT . "footer.php");
?>