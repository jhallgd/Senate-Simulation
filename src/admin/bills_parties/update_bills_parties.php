<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
$check = $da->update_bills_parties($_POST["pb_id"], $_POST["pvt_id"]);
if ($check) {
    echo '<script>window.location.replace("/admin/bills_parties");</script>';
} else {
    echo '<script>window.location.replace("/admin/bills_parties");</script>';
}

include_once($SUBROOT . "footer.php");
?>