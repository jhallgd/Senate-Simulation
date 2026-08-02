<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

echo '<h1>Parties</h1>';

$parties = $da->get_all_parties();
echo '<form action = "' . $base_href . 'admin/parties/party_detail.php" method="post">';
echo '<input type="hidden" id="pa_id" name="pa_id" value = -1>';
echo '<input type="submit" value="Create New" name = "submit">';
echo '</form></br>';

foreach ($parties as $party) {
    echo '<h3>' . $party->get_party_name() . '</h3>';
    echo '<form action = "' . $base_href . 'admin/parties/party_detail.php" method="post">';
    echo '<input type="hidden" id="pa_id" name="pa_id" value = ' . $party->get_id() . '>';
    echo '<input type="submit" value="Edit" name = "submit">';
    echo '</form>';

    echo '<form action = "' . $base_href . 'admin/parties/remove_party.php" method="post">';
    echo '<input type="hidden" id="pa_id" name="pa_id" value = ' . $party->get_id() . '>';
    echo '<input type="submit" value="Remove" name = "submit">';
    echo '</form></br>';
}


include_once($SUBROOT . "footer.php");
?>