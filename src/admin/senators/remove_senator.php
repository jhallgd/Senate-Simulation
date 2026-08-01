<?php
$SUBROOT = "../";
include_once($SUBROOT. "admin_header_profile.php");
$senator = $da->get_senator_by_id($_POST["se_id"]);
$check = $da->delete_senator($senator);
if ($check) {
    echo '<script>window.location.replace("' . $base_href . 'admin/senators");</script>';
} else {
    echo '<script>window.location.replace("' . $base_href . 'admin/senators");</script>';
}

include_once($SUBROOT . "footer.php");
?>