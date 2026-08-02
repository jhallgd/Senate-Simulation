<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
echo '<h1>Edit Party</h1>';
if ($_POST["pa_id"] == -1) {
    $data = [
        "pa_id" => -1,
        "pa_name" => "",
        "pa_location" => "",
        "pa_color" => "#FFFFFF",
    ];
    $party = new parties($data);
} else {
    $party = $da->get_party_by_id($_POST["pa_id"]);
}

echo '<form action = "' . $base_href . 'admin/parties/update_party.php" method="post">';

echo '<input type="hidden" id="pa_id" name="pa_id" value = ' . $party->get_id() . '>';

echo '<label for="pa_name">Party Name:</label><br>';
echo '<input type="text" id="pa_name" name="pa_name" value = "' . $party->get_party_name() . '"><br>';

echo '<label for="pa_location">Location:</label><br>';
echo '<input type="text" id="pa_location" name="pa_location" value = "' . $party->get_party_location() . '"><br>';

echo '<label for="pa_color">Party Color:</label><br>';
echo '<input type="color" id="pa_color" name="pa_color" value = "' . $party->get_party_color() . '"><br>';


echo '<input type="submit" value="Save">';
echo '</form>';


include_once($SUBROOT . "footer.php");
?>