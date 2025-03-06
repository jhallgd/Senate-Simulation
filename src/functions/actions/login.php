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

if($se_id == 0 OR $da->check_senate_id($se_id) == false){
    $se_id = 0;
}

if($se_id == 0){
    echo '<script>window.location.replace("/");</script>';
}else{
    $_SESSION["se"] = $se_id;
    echo '<script>window.location.replace("/pages/user_profile.php");</script>';

}
echo '</div>';
include_once($ROOT . "/components/footer.php");
?>