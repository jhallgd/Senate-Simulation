<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

echo '<h1>Parties</h1>';

$parties = $da->get_all_parties();
echo '<div class="adminToolbar">';
echo '<form action = "' . $base_href . 'admin/parties/party_detail.php" method="post">';
echo '<input type="hidden" id="pa_id_new" name="pa_id" value="-1">';
echo '<input type="submit" value="Create New" name = "submit">';
echo '</form>';
echo '</div>';

echo '<div class="adminTableWrap">';
echo '<table class="basicTable">';
echo '<tr><th>Party</th><th>Actions</th></tr>';
foreach ($parties as $party) {
    echo '<tr>';
    echo '<td>' . $party->get_party_name() . '</td>';
    echo '<td class="adminActions">';

    echo '<form class="adminInlineForm" action = "' . $base_href . 'admin/parties/party_detail.php" method="post">';
    echo '<input type="hidden" name="pa_id" value="' . $party->get_id() . '">';
    echo '<input type="submit" value="Edit" name = "submit">';
    echo '</form>';

    echo '<form class="adminInlineForm" action = "' . $base_href . 'admin/parties/remove_party.php" method="post">';
    echo '<input type="hidden" name="pa_id" value="' . $party->get_id() . '">';
    echo '<input type="submit" value="Remove" name = "submit">';
    echo '</form>';

    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';


include_once($SUBROOT . "footer.php");
?>