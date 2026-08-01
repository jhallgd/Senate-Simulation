<?php
$ROOT = dirname(__DIR__);
require($ROOT . '/functions/data_access.php');
$da = new data_access();

if (!isset($_SESSION)) {
    session_start();
}

$base_href = '/';
$configured_base = getenv('APP_BASE_PATH');
if ($configured_base !== false && trim($configured_base) !== '') {
    $configured_base = '/' . trim($configured_base, '/') . '/';
    $base_href = preg_replace('#/+#', '/', $configured_base);
} else {
    $script_name = $_SERVER['SCRIPT_NAME'] ?? '/';
    $script_name = str_replace('\\', '/', $script_name);
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
    if ($base_href === '') {
        $base_href = '/';
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