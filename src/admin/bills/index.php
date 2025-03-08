<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
echo '<h1>Bills</h1>';

$bills = $da->get_all_bills();
echo '<form action = "bill_detail.php" method="post">';
echo '<input type="hidden" id="bl_id" name="bl_id" value = -1>';
echo '<input type="submit" value="Create New" name = "submit">';
echo '</form></br>';

foreach ($bills as $bill) {
    echo '<h3>' . $bill->get_bill_title() . '</h3>';
    echo '<form action = "bill_detail.php" method="post">';
    echo '<input type="hidden" id="bl_id" name="bl_id" value = ' . $bill->get_bill_id() . '>';
    echo '<input type="submit" value="Edit" name = "submit">';
    echo '</form>';

    echo '<form action = "remove_bill.php" method="post">';
    echo '<input type="hidden" id="bl_id" name="bl_id" value = ' . $bill->get_bill_id() . '>';
    echo '<input type="submit" value="Remove" name = "submit">';
    echo '</form></br>';
}


include_once($SUBROOT . "footer.php");
?>