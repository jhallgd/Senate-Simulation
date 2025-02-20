<?php
$ROOT = dirname(__DIR__);
include_once("components/header.php");
?>

<div class="mainContainer">

	<h1>Test Login</h1>

	<p><a href='/functions/actions/login.php?s=1001'>Test 1001</a></p>
	<p><a href='/functions/actions/login.php?s=1002'>Test 1002</a></p>


	<h1>Tables for Reference</h1>
	<?php $da->show_all_tables(); ?>

	<?php include_once("components/footer.php"); ?>