<?php
$ROOT = './';
include_once("components/header.php");
?>

<div class="header_bar">
	<?php
	if (isset($_SESSION['se'])) {
		echo '<p>';
		echo 'Welcome, ' . $_SESSION['se']->get_full_name();
		echo ' | <a href="' . $ROOT . 'pages/user_profile.php"> Profile Page</a> | ';
		echo '<a href="' . $ROOT . 'functions/actions/logout.php">Log Out</a>';

		echo '</p>';
	} else {
		echo '<p>You need to login.</p>';
	}
	?>
</div>
<div class="mainContainer">

	<h1>Test Login</h1>

	<p><a href='<?php echo $ROOT ?>functions/actions/login.php?s=1001'>Test 1001</a></p>
	<p><a href='<?php echo $ROOT ?>functions/actions/login.php?s=1002'>Test 1002</a></p>


	<h1>Tables for Reference</h1>
	<?php $cf->simpleTable('Bills'); ?>
	<?php $cf->simpleTable('Senators'); ?>
	<?php $cf->simpleTable('Parties'); ?>

	<?php include_once("components/footer.php"); ?>