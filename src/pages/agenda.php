<?php
$ROOT = '../';
include_once($ROOT . "components/header_menu.php");

if (!isset($_SESSION['se'])) {
    echo '<p>You need to login.</p>';
} else {
    if(isset($_GET["c"])){
        $co_id = (int)$_GET["c"];
    }else{
        $co_id = 0;
    }
    
    if($co_id == 0){
        echo 'There is no committee.continue to <a href="'.$ROOT.'pages/user_profile.php">Portal Page</a>.';
    } else {
        $committee = $da->get_committee_by_id($co_id);
        echo '<div class = center_box>';
        echo '<h1>' . $committee->get_committee_name() . '</h1>';
        echo '<h3> Location: ' . $committee->get_committee_location() . '</h3>';
        echo '<h2>Agenda</h2>';
        echo '</div>';
        echo '<ul>';
        echo '<li>Call to order</li>';
        echo '<li>Consideration of the following legislation:</li>';
        echo '<ul>';
        foreach ($da->get_bills_by_co_id($committee->get_id()) as $bill) {
            echo '<li>';
            echo $bill->create_bill_link();
            echo '</li>';
        }
        echo '</ul>';
        echo '<li>Adjournment</li>';
        echo '</ul>';

        echo '<br>';

        $committee_members = $da->get_senators_committees_by_co_id($committee->get_id());
        if(sizeof($committee_members) > 0){
        echo '<h2 style="text-align: center;">Roster</h2>';
        echo '<ul>';
            foreach($committee_members as $committee_member){
                $senator = $da->get_senator_by_id($committee_member->get_senator_id());
                echo '<li>'.$senator->get_full_name().', '.$committee_member->get_committee_posotion().'</li>';
            }
            echo '</ul>';
        }

    }
}

include_once($ROOT . "/components/footer.php");
?>