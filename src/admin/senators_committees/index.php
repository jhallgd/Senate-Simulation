<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
echo '<h1>Assign Senators to Committees</h1>';

$committees = $da->get_all_committees();
$committee_position_types = $da->get_all_committee_position_types();

foreach ($committees as $committee) {
    echo '<div class="adminSection">';
    echo '<h3>' . $committee->get_committee_name() . '</h3>';
    $senator_committees = $da->get_senators_committees_by_co_id($committee->get_id());
    echo '<div class="adminTableWrap">';
    echo '<table class="basicTable">';
    echo '<tr><th>Senator</th><th>Committee</th><th>Position</th><th>Actions</th></tr>';
    if (count($senator_committees) === 0) {
        echo '<tr><td colspan="4">No senators assigned.</td></tr>';
    }
    foreach ($senator_committees as $senator_id) {
        $senator = $da->get_senator_by_id($senator_id->get_senator_id());
        $co_select_id = 'sc_co_id_' . $senator_id->get_id();
        $cpt_select_id = 'sc_cpt_id_' . $senator_id->get_id();
        $form_id = 'sc_form_' . $senator_id->get_id();

        echo '<tr>';
        echo '<td>' . $senator->get_full_name();
        echo '<input type="hidden" form="' . $form_id . '" name="sc_id" value = ' . $senator_id->get_id() . '>';
        echo '<input type="hidden" form="' . $form_id . '" name="sc_se_id" value = ' . $senator->get_id() . '>';
        echo '</td>';


        echo '<td><label for="' . $co_select_id . '">Committee:</label><br>';
        echo '<select form="' . $form_id . '" name = "sc_co_id" id="' . $co_select_id . '">';
        echo '<option value=-1>Unassigned</option>';
        foreach ($committees as $list_committee) {
            if ($list_committee->get_id() == $committee->get_id()) {
                $selected = ' selected';
            } else {
                $selected = '';
            }
            echo '<option value=' . $list_committee->get_id() . $selected . '>' . $list_committee->get_committee_name() . '</option>';
        }
        echo '</select></td>';

        echo '<td><label for="' . $cpt_select_id . '">Position:</label><br>';
        echo '<select form="' . $form_id . '" name = "sc_cpt_id" id="' . $cpt_select_id . '">';
        foreach ($committee_position_types as $committee_position_type) {
            if ($committee_position_type->get_id() == $senator_id->get_committee_posotion_id()) {
                $selected = ' selected';
            } else {
                $selected = '';
            }
            echo '<option value=' . $committee_position_type->get_id() . $selected . '>' . $committee_position_type->get_committee_position_name() . '</option>';
        }
        echo '</select></td>';

        echo '<td class="adminActions">';
        echo '<form id="' . $form_id . '" action = "' . $base_href . 'admin/senators_committees/update_senators_committees.php" method="post"></form>';
        echo '<input form="' . $form_id . '" type="submit" value="Save">';
        echo '</td>';
        echo '</tr>';
    }
    echo '</table>';
    echo '</div>';
    echo '</div>';
}


echo '<div class="adminSection">';
echo '<h3>Unassigned</h3>';
$unassigned_senators = $da->get_all_unassigned_senators_committees();
echo '<div class="adminTableWrap">';
echo '<table class="basicTable">';
echo '<tr><th>Senator</th><th>Committee</th><th>Position</th><th>Actions</th></tr>';
if (count($unassigned_senators) === 0) {
    echo '<tr><td colspan="4">No unassigned senators.</td></tr>';
}
foreach ($unassigned_senators as $senator_id) {
    $senator = $da->get_senator_by_id($senator_id->get_senator_id());
    $co_select_id = 'sc_unassigned_co_id_' . $senator_id->get_id();
    $cpt_select_id = 'sc_unassigned_cpt_id_' . $senator_id->get_id();
    $form_id = 'sc_unassigned_form_' . $senator_id->get_id();

    echo '<tr>';
    echo '<td>' . $senator->get_full_name();
    echo '<input type="hidden" form="' . $form_id . '" name="sc_id" value = ' . $senator_id->get_id() . '>';
    echo '<input type="hidden" form="' . $form_id . '" name="sc_se_id" value = ' . $senator->get_id() . '>';
    echo '</td>';

    echo '<td><label for="' . $co_select_id . '">Committee:</label><br>';
    echo '<select form="' . $form_id . '" name = "sc_co_id" id="' . $co_select_id . '">';
    echo '<option value=-1 selected>Unassigned</option>';
    foreach ($committees as $list_committee) {
        echo '<option value=' . $list_committee->get_id() . '>' . $list_committee->get_committee_name() . '</option>';
    }
    echo '</select></td>';

    echo '<td><label for="' . $cpt_select_id . '">Position:</label><br>';
    echo '<select form="' . $form_id . '" name = "sc_cpt_id" id="' . $cpt_select_id . '">';
    foreach ($committee_position_types as $committee_position_type) {
        if ($committee_position_type->get_id() == $senator_id->get_committee_posotion_id()) {
            $selected = ' selected';
        } else {
            $selected = '';
        }
        echo '<option value=' . $committee_position_type->get_id() . $selected . '>' . $committee_position_type->get_committee_position_name() . '</option>';
    }
    echo '</select></td>';

    echo '<td class="adminActions">';
    echo '<form id="' . $form_id . '" action = "' . $base_href . 'admin/senators_committees/update_senators_committees.php" method="post"></form>';
    echo '<input form="' . $form_id . '" type="submit" value="Save">';
    echo '</td>';
    echo '</tr>';
}
echo '</table>';
echo '</div>';
echo '</div>';




include_once($SUBROOT . "footer.php");
?>