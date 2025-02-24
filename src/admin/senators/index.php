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
    echo '<h1>Senators</h1>';
    $senators = $da->get_all_senators();
    foreach ($senators as $senator) {
        echo '</p>'.$senator->get_full_name().'</p>';
        echo '<form action = "senator_detail.php" method="post">';
        echo '<input type="hidden" id="se_id" name="se_id" value = '.$senator->get_id().'>';
        echo '<input type="submit" value="Edit" name = "submit">';
        echo '</form></br>';
    }
}

include_once($SUBROOT."footer.php");
?>