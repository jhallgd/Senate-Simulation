<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

echo '<h1>Committees</h1>';

$committees = $da->get_all_committees();
echo '<div class="adminToolbar">';
echo '<form action = "' . $base_href . 'admin/committees/committee_detail.php" method="post">';
echo '<input type="hidden" id="co_id_new" name="co_id" value="-1">';
echo '<input type="submit" value="Create New" name = "submit">';
echo '</form>';
echo '</div>';

echo '<div class="adminTableWrap">';
echo '<table class="basicTable">';
echo '<tr><th>Committee</th><th>Actions</th></tr>';
foreach ($committees as $committee) {
    echo '<tr>';
    echo '<td>' . $committee->get_committee_name() . '</td>';
    echo '<td class="adminActions">';

    echo '<form class="adminInlineForm" action = "' . $base_href . 'admin/committees/committee_detail.php" method="post">';
    echo '<input type="hidden" name="co_id" value="' . $committee->get_id() . '">';
    echo '<input type="submit" value="Edit" name = "submit">';
    echo '</form>';

    echo '<form class="adminInlineForm" action = "' . $base_href . 'admin/committees/remove_committee.php" method="post">';
    echo '<input type="hidden" name="co_id" value="' . $committee->get_id() . '">';
    echo '<input type="submit" value="Remove" name = "submit">';
    echo '</form>';

    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';


include_once($SUBROOT . "footer.php");
?>