<?php
$SUBROOT = "../";
include_once($SUBROOT. "admin_header_profile.php");
    list($party_id, $party_name) = explode("%", $_POST['se_pa_id'], 2);
    $data = [
        "se_id" => $_POST["se_id"],
        "se_first_name" => $_POST["se_first_name"],
        "se_last_name" => $_POST["se_last_name"],
        "se_title" => $_POST["se_title"],
        "se_pa_id" => (int) $party_id,
        "pa_name" => $party_name
    ];
    $senator = new senators($data);
    if ($senator->get_id() == -1) {
        $check = $da->create_senator($senator);
    } else {
        $check = $da->update_senator($senator);
    }
    if ($check) {
        echo '<script>window.location.replace("' . $base_href . 'admin/senators");</script>';
    }else{
        echo '<script>window.location.replace("' . $base_href . 'admin/senators");</script>';
    }

include_once($SUBROOT . "footer.php");
?>