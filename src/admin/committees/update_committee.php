<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

$data = [
    "co_id" => $_POST["co_id"],
    "co_name" => $_POST["co_name"],
    "co_location" => $_POST["co_location"]
];
$committee = new committees($data);
if ($committee->get_id() == -1) {
    $check = $da->create_committee($committee);
} else {
    $check = $da->update_committee($committee);
}
if ($check) {
    echo '<script>window.location.replace("/admin/committees");</script>';
} else {
    echo '<script>window.location.replace("/admin/committees");</script>';
}

include_once($SUBROOT . "footer.php");
?>