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
    echo '<h1>Committees</h1>';
    
    $committees = $da->get_all_committees();
    echo '<form action = "committee_detail.php" method="post">';
    echo '<input type="hidden" id="co_id" name="co_id" value = -1>';
    echo '<input type="submit" value="Create New" name = "submit">';
    echo '</form></br>';

    foreach ($committees as $committee) {
        echo '<h3>'.$committee->get_committee_name().'</h3>';
        echo '<form action = "committee_detail.php" method="post">';
        echo '<input type="hidden" id="co_id" name="co_id" value = '.$committee->get_id().'>';
        echo '<input type="submit" value="Edit" name = "submit">';
        echo '</form>';

        echo '<form action = "remove_committee.php" method="post">';
        echo '<input type="hidden" id="co_id" name="co_id" value = '.$committee->get_id().'>';
        echo '<input type="submit" value="Remove" name = "submit">';
        echo '</form></br>';
    }
}

include_once($SUBROOT."footer.php");
?>