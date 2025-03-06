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
    $committees = $da->get_all_committees();
    foreach ($committees as $committee) {
        $com_bills = $da->get_bills_by_co_id($committee->get_id());
        echo '<h2>' . $committee->get_committee_name() . '</h2>';
        echo '<h3>' . $committee->get_committee_location() . '</h3>';
        echo '<p><b>Bill:</b><br>';
        foreach ($com_bills as $bill) {
            echo ''. $bill->get_bill_title().': '. $bill->get_bill_short_text() .'<br>';
        }
        echo '</p>';
    }
}
?>