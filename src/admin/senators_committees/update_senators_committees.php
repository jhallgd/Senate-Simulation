<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
$check = $da->update_senators_committees($_POST["sc_id"], $_POST["sc_cpt_id"], $_POST["sc_se_id"], $_POST["sc_co_id"]);
if ($check) {
    echo '<script>window.location.replace("admin/senators_committees");</script>';
} else {
    echo '<script>window.location.replace("admin/senators_committees");</script>';
}

include_once($SUBROOT . "footer.php");
?>