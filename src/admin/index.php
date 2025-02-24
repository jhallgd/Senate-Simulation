<?php
$ROOT = dirname(__DIR__);
require($ROOT . '/functions/data_access.php');
$da = new data_access();

if (!isset($_SESSION)) {
    session_start();
}
?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Legislative Simulation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/../css/userStyle.css" rel="stylesheet" type="text/css">
</head>

<body>

    <?php

    

    if (!isset($_SESSION['ad'])) {

        if (array_key_exists('uname', $_POST)) {
            echo 'hello';
            if ($da->check_admin_login($_POST['uname'], $_POST['pass'])) {
                $_SESSION["ad"] = true;
                echo "Login Success";
            } else { 
               echo "You have entered wrong username/password"; 
            }
        }

        echo '<form action = '. htmlspecialchars($_SERVER['PHP_SELF']).' method="post">';
        echo '<p>Please login to continue.</p>';
        echo '<label for="uname">Username:</label><br>';
        echo '<input type="text" id="uname" name="uname"><br>';
        echo '<label for="pass">Password:</label><br>';
        echo '<input type="password" id="pass" name="pass"><br>';
        echo '<input type="submit" value="Login">';
        echo '</form>';
    } else {
        echo '<h1>Welcome Admin</h1>';
    }

    
    ?>


</body>

</html>