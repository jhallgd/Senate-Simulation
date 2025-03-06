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
        "pa_id" => $_POST["pa_id"],
        "pa_name" => $_POST["pa_name"],
        "pa_location" => $_POST["pa_location"],
        "pa_color" => $_POST["pa_color"]
    ];
    $party = new parties($data);
    if ($party->get_id() == -1) {
        $check = $da->create_party($party);
    } else {
        $check = $da->update_party($party);
    }
    if ($check) {
        echo '<script>window.location.replace("/admin/parties");</script>';
    }else{
        echo '<script>window.location.replace("/admin/parties");</script>';
    }

}

include_once($SUBROOT . "footer.php");
?>