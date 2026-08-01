<?php
$ROOT = '../';
include_once($ROOT . "components/header_menu.php");

if (!isset($_SESSION['se'])) {
    echo '<p>You need to login.</p>';
} else {
    $senator = $da->get_senator_by_id($_SESSION['se']);
    $pa_id = $senator->get_pa_id();
    if (is_null($pa_id)) {
        echo 'You have not picked a party yet. <a href="pages/join_party.php">Click here to select a party.</a>.';
    } else {
        $party = $da->get_party_by_id($pa_id);
        echo '<div class = center_box>';
        echo '<h1 style="color:' . $party->get_party_color() . '">' . $party->get_party_name() . '</h1>';
        echo '<a href="pages/join_party.php">Change party</a>';
        echo '<h3>Caucus Location: ' . $party->get_party_location() . '</h3>';
        echo '</div>';
        $da->create_bill_party_table($party->get_id());
        $da->create_party_senators_table($party->get_id());


        echo '</div>';
    }
}

include_once($ROOT . "/components/footer.php");
?>