<?php
if (!isset($_SESSION)) {
    session_start();
}
$ROOT = dirname(__DIR__);

require($ROOT . '/functions/data_access.php');
$da = new data_access();



?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Legislative Simulation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="/">
    <link href="/css/userStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="mainContainer">