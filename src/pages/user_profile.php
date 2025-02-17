<?php
$ROOT = '../';
include_once($ROOT . "components/header_menu.php");

if (!isset($_SESSION['se'])) {
    echo '<p>You need to login.</p>';
} else {
    $senator = $cf->getSenator($_SESSION['se']->get_id());
    echo '<h1>Senator ' . $senator->get_last_name() . '</h1>';

    echo '<h2>Party:</h2>';
    if ($senator->get_party() === 'none') {
        echo '<h3>Party Missing</h3><p><a href = "' . $ROOT . 'pages/join_party.php">Select Party</a></p>';
    } else {
        echo '<h3>' . $senator->get_party() . ' </h3>';
        echo '<p><a href = "' . $ROOT . 'pages/party.php">View Party Informaiton</a></p>';
    }
    $senator->show_committees();
    
    echo '<h2>Bills</h2>';
    $cf->create_bill_table();
}

?>

<?php include_once($ROOT . "/components/footer.php"); ?>