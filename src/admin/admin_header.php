<?php
if (!isset($_SESSION)) {
    session_start();
}
$ROOT = dirname(__DIR__);

require($ROOT . '/functions/data_access.php');
$da = new data_access();

$base_href = '/';
$configured_base = getenv('APP_BASE_PATH');
if ($configured_base !== false && trim($configured_base) !== '') {
    $configured_base = '/' . trim($configured_base, '/') . '/';
    $base_href = preg_replace('#/+#', '/', $configured_base);
} else {
    $script_name = $_SERVER['SCRIPT_NAME'] ?? '';
    $script_name = str_replace('\\', '/', $script_name);
    $src_position = strpos($script_name, '/src/');
    if ($src_position !== false) {
        $base_href = substr($script_name, 0, $src_position + 1);
        if ($base_href === '') {
            $base_href = '/';
        }
    }
}



?>
<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Legislative Simulation</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <base href="<?php echo htmlspecialchars($base_href, ENT_QUOTES, 'UTF-8'); ?>">
    <link href="css/userStyle.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class="mainContainer">