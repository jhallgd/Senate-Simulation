<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
echo '<h1>Assign Bills to Committees</h1>';

$committees = $da->get_all_committees();
$all_bills = $da->get_all_bills();

foreach ($committees as $committee) {
    echo '<h3>' . $committee->get_committee_name() . '</h3>';
    $bills = $da->get_bills_by_co_id($committee->get_id());
    foreach ($bills as $bill) {
        echo '<p>' . $bill->get_bill_title() . '</p>';
        echo '<form action = "' . $base_href . 'admin/bills_committees/remove_bills_committees.php" method="post">';
        echo '<input type="hidden" id="bl_id" name="bl_id" value = ' . $bill->get_bill_id() . '>';
        echo '<input type="hidden" id="co_id" name="co_id" value = ' . $committee->get_id() . '>';
        echo '<input type="submit" value="Remove" name = "submit">';
        echo '</form></br>';
    }


    echo '<form action = "' . $base_href . 'admin/bills_committees/update_bills_committees.php" method="post">';
    echo '<input type="hidden" id="co_id" name="co_id" value = ' . $committee->get_id() . '>';
    echo '<label for="bl_id">Add Bill:</label><br>';
    echo '<select name = "bl_id" id="bl_id">';
    foreach ($all_bills as $all_bill) {
        echo '<option value=' . $all_bill->get_bill_id() . '>' . $all_bill->get_bill_title() . '</option>';
    }
    echo '</select></br>';
    echo '<input type="submit" value="Add" name = "submit">';
    echo '</form></br>';
    echo '<hr>';

}

include_once($SUBROOT . "footer.php");
?>