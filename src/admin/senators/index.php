<?php
$SUBROOT = "../";
include_once($SUBROOT. "admin_header_profile.php");
echo '<h1>Senators</h1>';

$senators = $da->get_all_senators();
echo '<form action = "senator_detail.php" method="post">';
echo '<input type="hidden" id="se_id" name="se_id" value = -1>';
echo '<input type="submit" value="Create New" name = "submit">';
echo '</form></br>';

foreach ($senators as $senator) {
    echo '<h3>' . $senator->get_full_name() . '</h3>';
    echo '<form action = "senator_detail.php" method="post">';
    echo '<input type="hidden" id="se_id" name="se_id" value = ' . $senator->get_id() . '>';
    echo '<input type="submit" value="Edit" name = "submit">';
    echo '</form>';

    echo '<form action = "remove_senator.php" method="post">';
    echo '<input type="hidden" id="se_id" name="se_id" value = ' . $senator->get_id() . '>';
    echo '<input type="submit" value="Remove" name = "submit">';
    echo '</form></br>';
    echo '<a href = "/functions/actions/login.php?s=' . $senator->get_id() . '">View</a><br>';

    echo '<br><hr><br>';
}



include_once($SUBROOT . "footer.php");
?>