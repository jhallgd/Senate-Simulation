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

        $columnCount = 0;
        $half = sizeof($votes)/2;
        $left_column_string = '';
        $right_column_string = '';

        foreach ($vote_totals as $vt){
        echo '<span class = "totals" style="color:'.$vt->get_vt_color().'"><b>'.$vt->get_vt_name().': '.$vt->get_vote_totals().'</b></span>';
        }

        foreach ($votes as $vote) {
            if($columnCount%2!= 0){
                $left_column_string .= '<tr><td style="width: 50%"><span style="color:'.$vote->get_vt_color().'">'. strtoupper($vote->get_se_last_name()) .'</span></td>';
            }else{
                $right_column_string .= '<td style="width: 50%"><span style="color:'.$vote->get_vt_color().'">'. strtoupper($vote->get_se_last_name()) .'</span></td></tr>';
            }
            $columnCount++;
        }
        echo '<table class="senators">'.$left_column_string .$right_column_string.'</tr></table>';
    }
}

include_once($ROOT . "/components/footer.php");
?>