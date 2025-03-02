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
    echo '<h1>Edit Bill</h1>';
    if ($_POST["bl_id"] == -1){
        $data = [
            "bl_id" => -1,
            "bl_title" => "",
            "bl_short_text" => "",
            "bl_url" => ""
        ];
        $bill = new bills($data);
    }else{
        $bill = $da->get_bill_by_id($_POST["bl_id"]);
    }
    
    echo '<form action = "update_bill.php" method="post">';

    echo '<input type="hidden" id="bl_id" name="bl_id" value = '.$bill->get_bill_id().'>';

    echo '<label for="bl_title">Bill Title:</label><br>';
    echo '<input type="text" id="bl_title" name="bl_title" value = "'.$bill->get_bill_title().'"><br>';

    echo '<label for="bl_short_text">Bill Short Text:</label><br>';
    echo '<input type="text" id="bl_short_text" name="bl_short_text" value = "'.$bill->get_bill_short_text().'"><br>';

    echo '<label for="bl_url">Bill URL:</label><br>';
    echo '<input type="text" id="bl_url" name="bl_url" value = "'.$bill->get_bill_url().'"><br>';

    echo '<input type="submit" value="Save">';
    echo '</form>';
}

include_once($SUBROOT."footer.php");
?>