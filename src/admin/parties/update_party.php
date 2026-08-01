<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
$data = [
    "pa_id" => $_POST["pa_id"],
    "pa_name" => $_POST["pa_name"],
    "pa_location" => $_POST["pa_location"],
    "pa_color" => $_POST["pa_color"]
];
$party = new parties($data);
if ($party->get_id() == -1) {
    $check = $da->create_party($party);
} else {
    $check = $da->update_party($party);
}
if ($check) {
    echo '<script>window.location.replace("' . $base_href . 'admin/parties");</script>';
} else {
    echo '<script>window.location.replace("' . $base_href . 'admin/parties");</script>';
}

include_once($SUBROOT . "footer.php");
?>