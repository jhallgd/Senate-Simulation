<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");
$parties = $da->get_all_parties();
foreach ($parties as $party) {
    echo '<h2 style="color:' . $party->get_party_color() . '">' . $party->get_party_name() . ': ' . $da->get_party_count($party->get_id()) . '</h2>';
    $da->create_bill_party_table($party->get_id());
}

?>