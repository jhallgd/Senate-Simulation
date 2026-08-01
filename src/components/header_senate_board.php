<?php
$ROOT = dirname(__DIR__);
require($ROOT . '/functions/data_access.php');
$da = new data_access();
$page = $_SERVER['PHP_SELF'];
$sec = "3";

$base_href = '/';
$configured_base = getenv('APP_BASE_PATH');
if ($configured_base !== false && trim($configured_base) !== '') {
	$configured_base = '/' . trim($configured_base, '/') . '/';
	$base_href = preg_replace('#/+#', '/', $configured_base);
} else {
	$script_name = $_SERVER['SCRIPT_NAME'] ?? '';
	if ($script_name === '') {
		$script_name = $_SERVER['PHP_SELF'] ?? '/';
	}
	$script_name = str_replace('\\', '/', $script_name);

	$src_position = strpos($script_name, '/src/');
	if ($src_position !== false) {
		$base_href = substr($script_name, 0, $src_position + 1);
	} else {
		$script_dir = dirname($script_name);
		$script_dir = str_replace('\\', '/', $script_dir);

		if ($script_dir === '.' || $script_dir === '\\') {
			$script_dir = '/';
		}

		if (substr($script_dir, -4) === '/src') {
			$script_dir = substr($script_dir, 0, -4);
		}

		$script_dir = preg_replace('#/+#', '/', $script_dir);
		$base_href = rtrim($script_dir, '/') . '/';
	}

	if ($base_href === '') {
		$base_href = '/';
	}
}
?>

<!doctype html>
<html>
<head>
<meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
<meta charset="utf-8">
<title>Senate Simulation</title>
	<base href="<?php echo htmlspecialchars($base_href, ENT_QUOTES, 'UTF-8'); ?>">
	<link href="css/boardStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="mainContainer">