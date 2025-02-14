<?php
require(dirname(__DIR__) . '/objects/senators.php');

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
    <link href="<?php echo $ROOT . '/css/userStyle.css'; ?>" rel="stylesheet" type="text/css">
</head>

<body>
    <?php

    require(dirname(__DIR__) . '/functions/common_functions.php');

    $cf = new common_functions();
    ?>
