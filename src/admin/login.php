<?php


$ROOT = '../../';
include_once("admin_header.php");

echo '<div class="mainContainer">';
echo '<div class="center_box">';

if(isset($_POST["uname"])){
    $ad_name = $_POST["uname"];
}else{
    $ad_name = 0;
}
if(!isset($_POST["pass"])){
    $ad_name = 0;
}

if(!$da->check_admin_login($_POST['uname'], $_POST['pass'])){
    $ad_name = 0;
}

if($ad_name == 0){
    echo 'Login Failed. Please try again. <a href="/admin">Admin Page</a>';
}else{
    $_SESSION["ad"] = true;
    echo 'Login Success contine to <a href="/admin">Admin Page</a>.';

}
echo '</div>';
include_once($ROOT . "/components/footer.php");
?>