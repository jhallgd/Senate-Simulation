<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
echo '<h1>Bills</h1>';

$bills = $da->get_all_bills();
echo '<div class="adminToolbar">';
echo '<form action = "' . $base_href . 'admin/bills/bill_detail.php" method="post">';
echo '<input type="hidden" id="bl_id_new" name="bl_id" value="-1">';
echo '<input type="submit" value="Create New" name = "submit">';
echo '</form>';
echo '</div>';

echo '<div class="adminTableWrap">';
echo '<table class="basicTable">';
echo '<tr><th>Bill</th><th>Actions</th></tr>';
foreach ($bills as $bill) {
    echo '<tr>';
    echo '<td>' . $bill->get_bill_title() . '</td>';
    echo '<td class="adminActions">';

    echo '<form class="adminInlineForm" action = "' . $base_href . 'admin/bills/bill_detail.php" method="post">';
    echo '<input type="hidden" name="bl_id" value="' . $bill->get_bill_id() . '">';
    echo '<input type="submit" value="Edit" name = "submit">';
    echo '</form>';

    echo '<form class="adminInlineForm" action = "' . $base_href . 'admin/bills/remove_bill.php" method="post">';
    echo '<input type="hidden" name="bl_id" value="' . $bill->get_bill_id() . '">';
    echo '<input type="submit" value="Remove" name = "submit">';
    echo '</form>';

    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';


include_once($SUBROOT . "footer.php");
?>