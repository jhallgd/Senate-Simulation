<?php
$ROOT = '../../';
include_once($ROOT . "components/header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

if (isset($_GET["p"])) {
    $pa_id = (int) $_GET["p"];
} else {
    $pa_id = 0;
}

if ($pa_id == 0 or $cf->check_party_id($pa_id) == false) {
    $pa_id = 0;
}

if ($pa_id == 0) {
    echo 'Party changed failed please try again. <a href="' . $ROOT . 'pages/join_party.php">Back</a>';
} else {
    if ($cf->change_party($_SESSION['se']->get_id(), $pa_id)) {
        $_SESSION["se"] = $cf->getSenator($_SESSION['se']->get_id());
        echo 'Party change success, please contine to <a href="' . $ROOT . 'pages/user_profile.php">Portal Page</a>.';
    } else {
        echo 'Party changed failed please try again. <a href="' . $ROOT . 'pages/join_party.php">back</a>';
    }
}
echo '</div>';
include_once($ROOT . "/components/footer.php");
?>