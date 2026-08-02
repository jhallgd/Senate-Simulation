<?php
$ROOT = '../';
include_once($ROOT . "components/header_menu.php");

if (!isset($_SESSION['se'])) {
    echo '<p>You need to login.</p>';
} else {
    $senator = $da->get_senator_by_id($_SESSION['se']);
    $settings = $da->get_settings();
    if ($settings->get_start_session()) {
        echo '<h1>The Senate is in Session</h1>';
        echo '<h2>Senator ' . $senator->get_last_name() . '</h2>';

        if (!is_null($settings->get_active_bill())) {
            echo '<hr>';
            $bill = $da->get_bill_by_id($settings->get_active_bill());
            echo '<h2>Current Bill</h2>';
            echo '<h1>' . $bill->get_bill_title() . '</h1>';
            echo '<h2>' . $bill->get_bill_short_text() . '</h2>';

            $vote = $da->get_vote_by_se_bl_id($senator->get_id(), $bill->get_bill_id());
            $vote_types = $da->get_all_vote_types();

            echo '<form action="' . $base_href . 'pages/session.php" method="post">';
            foreach ($vote_types as $type) {
                if (array_key_exists($type->get_id(), $_POST)) {
                    $new_vote = $vote->change_vote($type->get_id());
                    $update_status = $da->update_vote($new_vote) ? "Success" : "Fail";
                }
                echo '<input type="submit" name='.$type->get_id().' class="vote_btn" style="background-color:' .$type->get_vt_color().'" value="'.$type->get_vt_name().'">';
            }
            echo '</form>';


        }

    } else {
        echo 'Session has ended please return to the <a href="pages/user_profile.php"><button>Join Session</button>Profiile Page</a>';
    }

}

?>

<?php include_once($ROOT . "/components/footer.php"); ?>