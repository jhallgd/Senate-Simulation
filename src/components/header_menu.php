<?php
$ROOT = '../';
include_once("header.php");
?>
<div class="header_bar">
    <?php
    if (isset($_SESSION['se'])) {
        $senator = $da->get_senator_by_id($_SESSION['se']);
        echo '<p>';
        echo 'Welcome, ' . $senator->get_full_name();
        echo ' | <a href="pages/user_profile.php"> Profile Page</a> | ';
        echo '<a href="functions/actions/logout.php">Log Out</a>';

        echo '</p>';
    } else {
        echo '<p>You need to login.</p>';
    }
    ?>
</div>
<div class="mainContainer">