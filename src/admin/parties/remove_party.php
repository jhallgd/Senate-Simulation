<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
$party = $da->get_party_by_id($_POST["pa_id"]);
$check = $da->delete_party($party);
if ($check) {
    echo '<script>window.location.replace("' . $base_href . 'admin/parties");</script>';
} else {
    echo '<script>window.location.replace("' . $base_href . 'admin/parties");</script>';
}
include_once($SUBROOT . "footer.php");
?>