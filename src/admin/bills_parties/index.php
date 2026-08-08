<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

echo '<h1>Assign Party Views</h1>';

$parties = $da->get_all_parties();
$parties_views = $da->get_all_party_views();

foreach ($parties as $party) {
    echo '<div class="adminSection">';
    echo '<h3>' . $party->get_party_name() . '</h3>';
    $bills = $da->get_bills_by_pa_id($party->get_id());

    echo '<div class="adminTableWrap">';
    echo '<table class="basicTable">';
    echo '<tr><th>Bill</th><th>Party View</th><th>Actions</th></tr>';
    if (count($bills) === 0) {
        echo '<tr><td colspan="3">No bills found for this party.</td></tr>';
    }

    foreach ($bills as $bill) {
        $row_id = $bill->get_party_bill_id();
        $form_id = 'bp_form_' . $row_id;
        $view_select_id = 'pvt_id_' . $row_id;

        echo '<tr>';
        echo '<td>' . $bill->get_bill_title();
        echo '<input type="hidden" form="' . $form_id . '" name="pb_id" value = ' . $row_id . '>';
        echo '</td>';

        echo '<td><label for="' . $view_select_id . '">Party View:</label><br>';
        echo '<select form="' . $form_id . '" name = "pvt_id" id="' . $view_select_id . '">';
        foreach ($parties_views as $parties_view) {
            if ($bill->get_pvt_id() == $parties_view->get_id()) {
                $selected = ' selected';
            } else {
                $selected = '';
            }
            echo '<option value=' . $parties_view->get_id() . $selected . '>' . $parties_view->get_view_name() . '</option>';
        }
        echo '</select></td>';

        echo '<td class="adminActions">';
        echo '<form id="' . $form_id . '" action = "' . $base_href . 'admin/bills_parties/update_bills_parties.php" method="post"></form>';
        echo '<input form="' . $form_id . '" type="submit" value="Save" name = "submit">';
        echo '</td>';
        echo '</tr>';
    }

    echo '</table>';
    echo '</div>';
    echo '</div>';

}


include_once($SUBROOT . "footer.php");
?>