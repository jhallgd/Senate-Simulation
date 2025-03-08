<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

$bill = $da->get_bill_by_id($_POST["bl_id"]);
$check = $da->delete_bill($bill);
if ($check) {
    echo '<script>window.location.replace("/admin/bills");</script>';
} else {
    echo '<script>window.location.replace("/admin/bills");</script>';
}

include_once($SUBROOT . "footer.php");
?>