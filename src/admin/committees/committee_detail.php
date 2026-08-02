<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
echo '<h1>Edit Committee</h1>';
if ($_POST["co_id"] == -1) {
    $data = [
        "co_id" => -1,
        "co_name" => "",
        "co_location" => ""
    ];
    $committee = new committees($data);
} else {
    $committee = $da->get_committee_by_id($_POST["co_id"]);
}

echo '<form action = "' . $base_href . 'admin/committees/update_committee.php" method="post">';

echo '<input type="hidden" id="co_id" name="co_id" value = ' . $committee->get_id() . '>';

echo '<label for="co_name">Committee Name:</label><br>';
echo '<input type="text" id="co_name" name="co_name" value = "' . $committee->get_committee_name() . '"><br>';

echo '<label for="co_location">Location:</label><br>';
echo '<input type="text" id="co_location" name="co_location" value = "' . $committee->get_committee_location() . '"><br>';


echo '<input type="submit" value="Save">';
echo '</form>';


include_once($SUBROOT . "footer.php");
?>