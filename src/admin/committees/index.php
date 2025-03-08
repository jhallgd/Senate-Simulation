<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

echo '<h1>Committees</h1>';

$committees = $da->get_all_committees();
echo '<form action = "committee_detail.php" method="post">';
echo '<input type="hidden" id="co_id" name="co_id" value = -1>';
echo '<input type="submit" value="Create New" name = "submit">';
echo '</form></br>';

foreach ($committees as $committee) {
    echo '<h3>' . $committee->get_committee_name() . '</h3>';
    echo '<form action = "committee_detail.php" method="post">';
    echo '<input type="hidden" id="co_id" name="co_id" value = ' . $committee->get_id() . '>';
    echo '<input type="submit" value="Edit" name = "submit">';
    echo '</form>';

    echo '<form action = "remove_committee.php" method="post">';
    echo '<input type="hidden" id="co_id" name="co_id" value = ' . $committee->get_id() . '>';
    echo '<input type="submit" value="Remove" name = "submit">';
    echo '</form></br>';
}


include_once($SUBROOT . "footer.php");
?>