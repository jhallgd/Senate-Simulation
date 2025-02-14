<?php
$ROOT = '../';
include_once($ROOT . "components/header_menu.php");

if (!isset($_SESSION['se'])) {
    echo '<p>You need to login.</p>';
} else {
    $senator = $cf->getSenator($_SESSION['se']->get_id());
    $pa_id = $senator->get_pa_id();
    if (is_null($pa_id)) {
        echo 'You have not picked a party yet. <a href="'.$ROOT.'pages/join_party.php">Click here to select a party.</a>.';
    } else {
        $party = $cf->get_party($pa_id);
        echo '<div class = center_box>';
        echo '<h1 style="color:' . $party->get_party_color() . '">' . $party->get_party_name() . '</h1>';
        echo '<h3>Caucus Location: ' . $party->get_party_location() . '</h3>';
        echo '</div>';
        echo '<h3>Party Members</h3>';
        $cf->create_party_senators($party->get_id());
        echo '</br>';
        echo '<h3>Bill Positions</h3>';
        $cf->create_party_views($party->get_id());
        echo '</div>';
    }
}

include_once($ROOT . "/components/footer.php");
?>