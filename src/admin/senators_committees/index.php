<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
echo '<h1>Assign Senators to Committees</h1>';

$committees = $da->get_all_committees();
$committee_position_types = $da->get_all_committee_position_types();

foreach ($committees as $committee) {
    echo '<h3>' . $committee->get_committee_name() . '</h3>';
    $senator_committees = $da->get_senators_committees_by_co_id($committee->get_id());
    foreach ($senator_committees as $senator_id) {
        $senator = $da->get_senator_by_id($senator_id->get_senator_id());

        echo '<table><tr>';
        echo '<td>' . $senator->get_full_name() . '</td>';
        echo '<form action = "update_senators_committees.php" method="post">';


        echo '<input type="hidden" id="sc_id" name="sc_id" value = ' . $senator_id->get_id() . '>';
        echo '<input type="hidden" id="sc_se_id" name="sc_se_id" value = ' . $senator->get_id() . '>';


        echo '<td><label for="sc_co_id">Committee:</label><br></td>';
        echo '<td><select name = "sc_co_id" id="sc_co_id">';
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

        echo '<td><label for="sc_cpt_id">Position:</label><br></td>';
        echo '<td><select name = "sc_cpt_id" id="sc_cpt_id">';
        foreach ($committee_position_types as $committee_position_type) {
            if ($committee_position_type->get_id() == $senator_id->get_committee_posotion_id()) {
                $selected = ' selected';
            } else {
                $selected = '';
            }
            echo '<option value=' . $committee_position_type->get_id() . $selected . '>' . $committee_position_type->get_committee_position_name() . '</option>';
        }
        echo '</select></td>';

        echo '<td><input type="submit" value="Save"><td>';
        echo '</form>';
        echo '</tr></table><br>';
    }
}


echo '<br><h3>Unassigned</h3>';
$unassigned_senators = $da->get_all_unassigned_senators_committees();
foreach ($unassigned_senators as $senator_id) {
    $senator = $da->get_senator_by_id($senator_id->get_senator_id());

    echo '<table><tr>';
    echo '<td>' . $senator->get_full_name() . '</td>';
    echo '<form action = "update_senators_committees.php" method="post">';

    echo '<input type="hidden" id="sc_id" name="sc_id" value = ' . $senator_id->get_id() . '>';
    echo '<input type="hidden" id="sc_se_id" name="sc_se_id" value = ' . $senator->get_id() . '>';

    echo '<td><label for="sc_co_id">Committee:</label><br></td>';
    echo '<td><select name = "sc_co_id" id="sc_co_id">';
    echo '<option value=-1 selected>Unassigned</option>';
    foreach ($committees as $list_committee) {
        echo '<option value=' . $list_committee->get_id() . '>' . $list_committee->get_committee_name() . '</option>';
    }
    echo '</select></td>';

    echo '<td><label for="sc_cpt_id">Position:</label><br></td>';
    echo '<td><select name = "sc_cpt_id" id="sc_cpt_id">';
    foreach ($committee_position_types as $committee_position_type) {
        if ($committee_position_type->get_id() == $senator_id->get_committee_posotion_id()) {
            $selected = ' selected';
        } else {
            $selected = '';
        }
        echo '<option value=' . $committee_position_type->get_id() . $selected . '>' . $committee_position_type->get_committee_position_name() . '</option>';
    }
    echo '</select></td>';

    echo '<td><input type="submit" value="Save"><td>';
    echo '</form>';
    echo '</tr></table><br>';
}




include_once($SUBROOT . "footer.php");
?>