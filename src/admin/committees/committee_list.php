<?php
$SUBROOT = "../";
include_once($SUBROOT . "admin_header_profile.php");

$committees = $da->get_all_committees();
foreach ($committees as $committee) {
    $com_bills = $da->get_bills_by_co_id($committee->get_id());
    echo '<h2>' . $committee->get_committee_name() . '</h2>';
    echo '<h3>' . $committee->get_committee_location() . '</h3>';
    echo '<p><b>Bill:</b><br>';
    foreach ($com_bills as $bill) {
        echo '' . $bill->get_bill_title() . ': ' . $bill->get_bill_short_text() . '<br>';
    }
    echo '</p>';
}

?>