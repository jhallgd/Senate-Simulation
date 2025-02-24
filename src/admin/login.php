<?php


$ROOT = '../../';
include_once($ROOT . "components/header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

if(isset($_GET["ad"])){
    $ad_id = (int)$_GET["ad"];
}else{
    $ad_id = 0;
}

if($ad_id == 0){
    echo 'Login Failed. Please try again.';
}else{
    $_SESSION["ad"] = true;
    echo 'Login Success contine to <a href="/admin">Admin Page</a>.';

}
echo '</div>';
include_once($ROOT . "/components/footer.php");
?>