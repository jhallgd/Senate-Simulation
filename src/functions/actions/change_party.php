<?php
$ROOT = '../../';
include_once($ROOT . "components/header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

if (isset($_GET["p"])) {
    $pa_id = (int) $_GET["p"];
} else {
    $pa_id = 0;
}

if ($pa_id == 0 or $da->check_party_by_id($pa_id) == false) {
    $pa_id = 0;
}

if ($pa_id == 0) {
    echo '<script>window.location.replace("pages/join_party.php");</script>';
} else {
    $party = $da->get_party_by_id($pa_id);
    $senator = $da->get_senator_by_id($_SESSION['se']);
    $updated_senator = new senators(['se_id'=>$senator->get_id(), 
    'se_first_name'=>$senator->get_first_name(), 
    'se_last_name'=>$senator->get_last_name(), 
    'se_title'=>$senator->get_title(), 
    'se_pa_id'=>$pa_id,
    'pa_name'=>$party->get_party_name()
]);

    if ($da->update_senator($updated_senator)) {
        echo '<script>window.location.replace("pages/user_profile.php");</script>';
    } else {
        echo '<script>window.location.replace("pages/join_party.php");</script>';
    }
}
echo '</div>';
include_once($ROOT . "/components/footer.php");
?>