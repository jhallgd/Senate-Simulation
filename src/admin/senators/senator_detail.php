<?php
$SUBROOT = "../";
include_once($SUBROOT. "admin_header_profile.php");

echo '<h1>Edit Senator</h1>';
if ($_POST["se_id"] == -1) {
    $data = [
        "se_id" => -1,
        "se_first_name" => "",
        "se_last_name" => "",
        "se_title" => "",
        "se_pa_id" => 0,
        "pa_name" => ""
    ];
    $senator = new senators($data);
} else {
    $senator = $da->get_senator_by_id($_POST["se_id"]);
}

$parties = $da->get_all_parties();
echo '<form action = "' . $base_href . 'admin/senators/update_senator.php" method="post">';

echo '<input type="hidden" id="se_id" name="se_id" value = ' . $senator->get_id() . '>';

echo '<label for="se_first_name">First Name:</label><br>';
echo '<input type="text" id="se_first_name" name="se_first_name" value = "' . $senator->get_first_name() . '"><br>';

echo '<label for="se_last_name">Last Name:</label><br>';
echo '<input type="text" id="se_last_name" name="se_last_name" value = "' . $senator->get_last_name() . '"><br>';

echo '<label for="se_title">Title:</label><br>';
echo '<input type="text" id="se_title" name="se_title" value = "' . $senator->get_title() . '"><br>';

echo '<label for="se_pa_id">Party:</label><br>';
echo '<select name = "se_pa_id" id="se_pa_id">';
echo '<option value="0%none">None</option>';
foreach ($parties as $party) {
    if ($party->get_id() == $senator->get_pa_id()) {
        $selected = ' selected';
    } else {
        $selected = '';
    }
    echo '<option value="' . $party->get_id() . '%' . $party->get_party_name() . '"' . $selected . '>' . $party->get_party_name() . '</option>';
}
echo '</select></br>';


echo '<input type="submit" value="Save">';
echo '</form>';


include_once($SUBROOT . "footer.php");
?>