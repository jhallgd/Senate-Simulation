<?php
$ROOT = '../';
include_once($ROOT . "components/header_menu.php");

if (!isset($_SESSION['se'])) {
    echo '<p>You need to login.</p>';
} else {
    echo '<h1>Senator ' . $_SESSION['se']->get_last_name() . '</h1>';
    $parties = $cf->get_parties();
    foreach ($parties as $party) {
        echo '<h2 style="color:' . $party->get_party_color() . '">' . $party->get_party_name() . '</h2>';
        $cf->create_party_views($party->get_id());
        echo '<a href = "'.$ROOT.'functions/actions/change_party.php?p='.$party->get_id().'"><button style="background-color:' . $party->get_party_color() . '">Join the ' . $party->get_party_name() . '</button></a>';
    }
}

include_once($ROOT . "/components/footer.php");
?>