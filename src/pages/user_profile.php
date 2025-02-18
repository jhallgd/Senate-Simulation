<?php
$ROOT = '../';
include_once($ROOT . "components/header_menu.php");

if (!isset($_SESSION['se'])) {
    echo '<p>You need to login.</p>';
} else {
    $senator = $da->get_senator_by_id($_SESSION['se']);
    echo '<h1>Senator ' . $senator->get_last_name() . '</h1>';

    echo '<h2>Party:</h2>';
    if ($senator->get_party() === 'none') {
        echo '<h3>Party Missing</h3><p><a href = "/pages/join_party.php">Select Party</a></p>';
    } else {
        echo '<h3>' . $senator->get_party() . ' </h3>';
        echo '<p><a href = "/pages/party.php">View Party Informaiton</a></p>';
    }
    $committees = $da->get_committees_by_se_id($senator->get_id());


        if (sizeof($committees) == 0) {
            echo '<h2>Committee:</h2>';
            echo '<p>You have not been placed on a committee.</p>';
        } else {
            if (sizeof($committees) > 1) {
                echo '<h2>Committees:</h2>';
            } else {
                echo '<h2>Committee:</h2>';
            }
            foreach ($committees as $committee) {
                echo '<h3>' . $committee->get_committee_name() . '</h3>';
                echo '<p>Position: ' . $committee->get_committee_position() . '</p>';
                echo '<p>' . $committee->get_agenda_url() . '</p>';
            }
        }
    
    $da->create_bill_table();
    $da->create_commitee_list();

    
}

?>

<?php include_once($ROOT . "/components/footer.php"); ?>