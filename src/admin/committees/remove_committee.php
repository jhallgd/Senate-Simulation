<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
$committee = $da->get_committee_by_id($_POST["co_id"]);
$check = $da->delete_committee($committee);
if ($check) {
    echo '<script>window.location.replace("' . $base_href . 'admin/committees");</script>';
} else {
    echo '<script>window.location.replace("' . $base_href . 'admin/committees");</script>';
}

include_once($SUBROOT . "footer.php");
?>