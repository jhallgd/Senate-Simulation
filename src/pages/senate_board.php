<?php
$ROOT = '../';
include_once($ROOT . "components/header_senate_board.php");

$settings = $da->get_settings();
if ($settings->get_start_session()) {
    if (!is_null($settings->get_active_bill())) {
        $bill = $da->get_bill_by_id($settings->get_active_bill());
        echo '<h1>' . $bill->get_bill_title() . '</h1>';
        echo '<h2>' . $bill->get_bill_short_text() . '</h2>';
        echo '<h3>1st Reading</h3>';
        $votes = $da->get_all_votes_by_bl_id($bill->get_bill_id());
        $vote_totals = $da->get_all_vote_types_totals($bill->get_bill_id());

        foreach ($vote_totals as $vt) {
            echo '<span class = "totals" style="color:' . $vt->get_vt_color() . '"><b>' . $vt->get_vt_name() . ': ' . $vt->get_vote_totals() . '</b></span>';
        }

        $columnCount = 0;
        $half = (sizeof($votes) / 2);
        $left_column_string = '';
        $right_column_string = '';

        $left_column = [];
        $right_column = [];
        $left_count = 0;
        $right_count = 0;

        foreach ($votes as $vote) {
            if ($columnCount <= $half) {
                array_push($left_column, $vote);
            } else {
                array_push($right_column, $vote);
            }
            $columnCount++;
        }
        $columnCount = 0;
        foreach ($left_column as $lcv) {
            if ($columnCount < sizeof($right_column)) {
                $right_column_string = '<td style="width: 50%"><span style="color:' . $right_column[$columnCount]->get_vt_color() . '">' . strtoupper($right_column[$columnCount]->get_se_last_name()) . '</span></td>';
            } else {
                $right_column_string = '';
            }


            $left_column_string .= '<tr><td style="width: 50%"><span style="color:' . $left_column[$columnCount]->get_vt_color() . '">' . strtoupper($left_column[$columnCount]->get_se_last_name()) . '</span></td>' . $right_column_string . '</tr>';
            $columnCount++;
        }

        echo '<table class="senators">' . $left_column_string . '</table>';
    }
}
include_once($ROOT . "/components/footer.php");
?>