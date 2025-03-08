<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

echo '<h1>Assign Party Views</h1>';

$parties = $da->get_all_parties();
$parties_views = $da->get_all_party_views();

foreach ($parties as $party) {
    echo '<h3>' . $party->get_party_name() . '</h3>';
    $bills = $da->get_bills_by_pa_id($party->get_id());
    foreach ($bills as $bill) {
        echo '<p>' . $bill->get_bill_title() . '</p>';
        echo '<form action = "update_bills_parties.php" method="post">';
        echo '<input type="hidden" id="pb_id" name="pb_id" value = ' . $bill->get_party_bill_id() . '>';
        echo '<label for="pvt_id">Party View:</label><br>';
        echo '<select name = "pvt_id" id="pvt_id">';
        foreach ($parties_views as $parties_view) {
            if ($bill->get_pvt_id() == $parties_view->get_id()) {
                $selected = ' selected';
            } else {
                $selected = '';
            }
            echo '<option value=' . $parties_view->get_id() . $selected . '>' . $parties_view->get_view_name() . '</option>';
        }
        echo '</select></br>';
        echo '<input type="submit" value="Save" name = "submit">';

        echo '</form></br>';
    }
    echo '<hr>';

}


include_once($SUBROOT . "footer.php");
?>