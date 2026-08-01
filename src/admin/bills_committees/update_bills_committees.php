<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
$check = $da->create_committee_bill($_POST["bl_id"], $_POST["co_id"]);
if ($check) {
    echo '<script>window.location.replace("' . $base_href . 'admin/bills_committees");</script>';
} else {
    echo '<script>window.location.replace("' . $base_href . 'admin/bills_committees");</script>';
}

include_once($SUBROOT . "footer.php");
?>