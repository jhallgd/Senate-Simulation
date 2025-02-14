<?php


$ROOT = '../../';
include_once($ROOT . "components/header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

if(isset($_GET["s"])){
    $se_id = (int)$_GET["s"];
}else{
    $se_id = 0;
}

if($se_id == 0 OR $cf->checkSenateId($se_id) == false){
    $se_id = 0;
}

if($se_id == 0){
    echo 'Login Failed. Please try again.';
}else{
    $senator = $cf->getSenator($se_id);
    $_SESSION["se"] = $senator;
    echo 'Login Success contine to <a href="'.$ROOT.'pages/user_profile.php">Portal Page</a>.';

}
echo '</div>';
include_once($ROOT . "/components/footer.php");
?>