<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

$data = [
    "bl_id" => $_POST["bl_id"],
    "bl_title" => $_POST["bl_title"],
    "bl_short_text" => $_POST["bl_short_text"],
    "bl_url" => $_POST["bl_url"]
];
$bill = new bills($data);
if ($bill->get_bill_id() == -1) {
    $check = $da->create_bill($bill);
} else {
    $check = $da->update_bill($bill);
}
if ($check) {
    echo '<script>window.location.replace("admin/bills");</script>';
} else {
    echo '<script>window.location.replace("admin/bills");</script>';
}

include_once($SUBROOT . "footer.php");
?>