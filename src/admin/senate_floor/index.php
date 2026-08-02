<?php
$SUBROOT = "../";
include_once($SUBROOT. "admin_header_profile.php");

$settings = $da->get_settings();

if (isset($_POST['st_start_session'])) {
    $boolean = $_POST['st_start_session'] == 1;
    $data = [
        'st_id' => $settings->get_id(),
        'st_start_session' => $boolean,
        'st_active_bill' => $settings->get_active_bill(),
        'st_default_vt' => $settings->get_default_vote_type(),
        'st_default_pvt' => $settings->get_default_party_view()
    ];
    $new_settings = new settings($data);
    if ($da->update_settings($new_settings)) {
        echo 'Updated<br>';
    } else {
        echo 'Failed to update<br>';
    }
}

if (isset($_POST['st_active_bill'])) {
    $data = [
        'st_id' => $settings->get_id(),
        'st_start_session' => $settings->get_start_session(),
        'st_active_bill' => $_POST['st_active_bill'],
        'st_default_vt' => $settings->get_default_vote_type(),
        'st_default_pvt' => $settings->get_default_party_view()
    ];
    $new_settings = new settings($data);
    if ($da->update_settings($new_settings)) {
        echo 'Updated<br>';
    } else {
        echo 'Failed to update<br>';
    }
}

if (isset($_POST['clear_bill'])) {

    if ($da->clear_votes_by_bl_id($_POST['clear_bill'])) {
        echo 'Cleared<br>';
    } else {
        echo 'Failed to clear<br>';
    }
}

echo '<h1>Senate Floor Functions</h1>';

$settings = $da->get_settings();



if ($settings->get_start_session()) {
    echo '<form action = "' . $base_href . 'admin/senate_floor/" method="post">';
    echo '<input type="hidden" id="st_start_session" name="st_start_session" value = 0>';
    echo '<input type="submit" value="End Session">';
    echo '</form>';

} else {
    echo '<form action = "' . $base_href . 'admin/senate_floor/" method="post">';
    echo '<input type="hidden" id="st_start_session" name="st_start_session" value = 1>';
    echo '<input type="submit" value="Start Session">';
    echo '</form>';
}
echo '<br>';

$bills = $da->get_all_bills();

echo '<form action = "' . $base_href . 'admin/senate_floor/" method="post">';
echo '<label for="st_active_bill">Selected Bill:</label><br>';
echo '<select name = "st_active_bill" id="st_active_bill">';
echo '<option value=0>None</option>';
foreach ($bills as $bill) {
    if ($bill->get_bill_id() == $settings->get_active_bill()) {
        $selected = ' selected';
    } else {
        $selected = '';
    }
    echo '<option value=' . $bill->get_bill_id() . $selected . '>' . $bill->get_bill_title() . '</option>';
}
echo '</select>';
echo '<input type="submit" value="Update">';
echo '</form>';

echo '<br>';

echo '<form action = "' . $base_href . 'admin/senate_floor/" method="post">';
echo '<label for="clear_bill">Clear Bill Votes:</label><br>';
echo '<select name = "clear_bill" id="clear_bill">';
foreach ($bills as $bill) {
    echo '<option value=' . $bill->get_bill_id() . '>' . $bill->get_bill_title() . '</option>';
}
echo '</select>';
echo '<input type="submit" value="Clear">';
echo '</form>';



include_once($SUBROOT . "footer.php");
?>