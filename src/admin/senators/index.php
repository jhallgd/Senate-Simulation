<?php
$SUBROOT = "../";
include_once($SUBROOT. "admin_header_profile.php");
echo '<h1>Senators</h1>';

$senators = $da->get_all_senators();
echo '<div class="adminToolbar">';
echo '<form action = "' . $base_href . 'admin/senators/senator_detail.php" method="post">';
echo '<input type="hidden" id="se_id_new" name="se_id" value="-1">';
echo '<input type="submit" value="Create New" name = "submit">';
echo '</form>';
echo '</div>';

echo '<div class="adminTableWrap">';
echo '<table class="basicTable">';
echo '<tr><th>Senator</th><th>Actions</th></tr>';
foreach ($senators as $senator) {
    echo '<tr>';
    echo '<td>' . $senator->get_full_name() . '</td>';
    echo '<td class="adminActions">';

    echo '<form class="adminInlineForm" action = "' . $base_href . 'admin/senators/senator_detail.php" method="post">';
    echo '<input type="hidden" name="se_id" value="' . $senator->get_id() . '">';
    echo '<input type="submit" value="Edit" name = "submit">';
    echo '</form>';

    echo '<form class="adminInlineForm" action = "' . $base_href . 'admin/senators/remove_senator.php" method="post">';
    echo '<input type="hidden" name="se_id" value="' . $senator->get_id() . '">';
    echo '<input type="submit" value="Remove" name = "submit">';
    echo '</form>';

    echo '<a href="functions/actions/login.php?s=' . $senator->get_id() . '">View</a>';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';



include_once($SUBROOT . "footer.php");
?>