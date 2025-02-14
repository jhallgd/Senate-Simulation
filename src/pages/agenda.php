<?php
$ROOT = '../';
include_once($ROOT . "components/header_menu.php");

if (!isset($_SESSION['se'])) {
    echo '<p>You need to login.</p>';
} else {
    $senator = $cf->getSenator($_SESSION['se']->get_id());
    $co_id = $senator->get_co_id();
    if (is_null($co_id)) {
        echo 'You have not been assigned a committee yet. Return to the <a href="'.$ROOT.'pages/user_profile.php">Portal Page.</a>.';
    } else {
        $committee = $cf->get_committee($co_id);
        echo '<div class = center_box>';
        echo '<h1>' . $committee->get_committee_name() . '</h1>';
        echo '<h3> Location: ' . $committee->get_committee_location() . '</h3>';
        echo '<h2>Agenda</h2>';
        echo '</div>';
        echo '<ul>';
        echo '<li>Call to order</li>';
        echo '<li>Consideration of the following legislation:</li>';
        echo '<ul>';
        foreach ($committee->get_committee_bills() as $bill) {
            echo '<li>';
            $bill->create_bill_link();
            echo '</li>';
        }
        echo '</ul>';
        echo '<li>Adjournment</li>';
        echo '</ul>';
    }
}

include_once($ROOT . "/components/footer.php");
?>