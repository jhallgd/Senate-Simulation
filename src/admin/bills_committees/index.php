<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
echo '<h1>Assign Bills to Committees</h1>';

$committees = $da->get_all_committees();
$all_bills = $da->get_all_bills();

foreach ($committees as $committee) {
    echo '<div class="adminSection">';
    echo '<h3>' . $committee->get_committee_name() . '</h3>';
    $bills = $da->get_bills_by_co_id($committee->get_id());

    echo '<div class="adminTableWrap">';
    echo '<table class="basicTable">';
    echo '<tr><th>Bill</th><th>Actions</th></tr>';
    if (count($bills) === 0) {
        echo '<tr><td colspan="2">No bills assigned.</td></tr>';
    }
    foreach ($bills as $bill) {
        echo '<tr>';
        echo '<td>' . $bill->get_bill_title() . '</td>';
        echo '<td class="adminActions">';
        echo '<form class="adminInlineForm" action = "' . $base_href . 'admin/bills_committees/remove_bills_committees.php" method="post">';
        echo '<input type="hidden" name="bl_id" value="' . $bill->get_bill_id() . '">';
        echo '<input type="hidden" name="co_id" value="' . $committee->get_id() . '">';
        echo '<input type="submit" value="Remove" name = "submit">';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';

    $bill_select_id = 'bl_id_' . $committee->get_id();
    echo '<div class="adminToolbar">';
    echo '<form action = "' . $base_href . 'admin/bills_committees/update_bills_committees.php" method="post">';
    echo '<input type="hidden" name="co_id" value="' . $committee->get_id() . '">';
    echo '<label for="' . $bill_select_id . '">Add Bill:</label><br>';
    echo '<select name = "bl_id" id="' . $bill_select_id . '">';
    foreach ($all_bills as $all_bill) {
        echo '<option value=' . $all_bill->get_bill_id() . '>' . $all_bill->get_bill_title() . '</option>';
    }
    echo '</select><br>';
    echo '<input type="submit" value="Add" name = "submit">';
    echo '</form>';
    echo '</div>';
    echo '</div>';

}

include_once($SUBROOT . "footer.php");
?>