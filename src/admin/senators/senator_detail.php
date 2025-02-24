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
    echo '<h1>Edit Senator</h1>';
    $senator = $da->get_senator_by_id($_POST["se_id"]);
    $parties = $da->get_all_parties();
    $committees = $da->get_all_committees();
    echo '<form action = "update_senator.php" method="post">';

    echo '<input type="hidden" id="se_id" name="se_id" value = '.$senator->get_id().'>';

    echo '<label for="se_first_name">First Name:</label><br>';
    echo '<input type="text" id="se_first_name" name="se_first_name" value = "'.$senator->get_first_name().'"><br>';

    echo '<label for="se_last_name">Last Name:</label><br>';
    echo '<input type="text" id="se_last_name" name="se_last_name" value = "'.$senator->get_last_name().'"><br>';

    echo '<label for="se_title">Title:</label><br>';
    echo '<input type="text" id="se_title" name="se_title" value = "'.$senator->get_title().'"><br>';

    echo '<label for="se_pa_id">Party:</label><br>';
    echo '<select name = "se_pa_id" id="se_pa_id">';
    echo '<option value="0%none">None</option>';
    foreach ($parties as $party) {
        if ($party->get_id() == $senator->get_pa_id()){
            $selected = ' selected';
        }else{
            $selected = '';
        }
        echo '<option value="'.$party->get_id().'%'.$party->get_party_name().'"'.$selected.'>'.$party->get_party_name().'</option>';
    }
    echo '</select></br>';


    echo '<input type="submit" value="Save">';
    echo '</form>';
}

include_once($SUBROOT."footer.php");
?>