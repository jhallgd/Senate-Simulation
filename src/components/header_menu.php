<?php
$ROOT = '../';
include_once($ROOT . "components/header.php");
?>
<div class="header_bar">
    <?php
    if (isset($_SESSION['se'])) {
        echo '<p>';
        echo 'Welcome, ' . $_SESSION['se']->get_full_name();
        echo ' | <a href="' . $ROOT . 'pages/user_profile.php"> Profile Page</a> | ';
        echo '<a href="' . $ROOT . 'functions/actions/logout.php">Log Out</a>';

        echo '</p>';
    } else {
        echo '<p>You need to login.</p>';
    }
    ?>
</div>
<div class="mainContainer">