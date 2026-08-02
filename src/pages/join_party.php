<?php
$ROOT = '../';
include_once($ROOT . "components/header_menu.php");

if (!isset($_SESSION['se'])) {
    echo '<p>You need to login.</p>';
} else {
    $senator = $da->get_senator_by_id($_SESSION['se']);
    echo '<h1>Senator ' . $senator->get_last_name() . '</h1>';
    $parties = $da->get_all_parties();
    foreach ($parties as $party) {
        echo '<h2 style="color:' . $party->get_party_color() . '">' . $party->get_party_name() . '</h2>';
        $da->create_bill_party_table($party->get_id());
        echo '<a href = "' . $base_href . 'functions/actions/change_party.php?p=' . $party->get_id() . '"><button style="background-color:' . $party->get_party_color() . '">Join the ' . $party->get_party_name() . '</button></a>';
    }
}

include_once($ROOT . "/components/footer.php");
?>