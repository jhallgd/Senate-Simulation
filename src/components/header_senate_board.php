<?php
$ROOT = dirname(__DIR__);
require($ROOT . '/functions/data_access.php');
$da = new data_access();
$page = $_SERVER['PHP_SELF'];
$sec = "3";
?>

<!doctype html>
<html>
<head>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<meta charset="utf-8">
<title>Senate Simulation</title>
	<link href="/../css/boardStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="mainContainer">