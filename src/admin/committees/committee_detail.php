<?php
$SUBROOT = "../";
include_once($SUBROOT."admin_header.php");

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
    echo "<a href ='/admin/'>Return Home</a>";
    echo '<h1>Edit Committee</h1>';
    if ($_POST["co_id"] == -1){
        $data = [
            "se_id" => -1,
            "co_name" => "",
            "co_location" => ""
        ];
        $committee = new committees($data);
    }else{
        $committee = $da->get_committee_by_id($_POST["co_id"]);
    }
    
    echo '<form action = "update_committee.php" method="post">';

    echo '<input type="hidden" id="co_id" name="co_id" value = '.$committee->get_id().'>';

    echo '<label for="co_name">Committee Name:</label><br>';
    echo '<input type="text" id="co_name" name="co_name" value = "'.$committee->get_committee_name().'"><br>';

    echo '<label for="co_location">Location:</label><br>';
    echo '<input type="text" id="co_location" name="co_location" value = "'.$committee->get_committee_location().'"><br>';


    echo '<input type="submit" value="Save">';
    echo '</form>';
}

include_once($SUBROOT."footer.php");
?>