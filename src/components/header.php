<?php
$ROOT = dirname(__DIR__);
require($ROOT . '/functions/data_access.php');
$da = new data_access();

$session_timeout_seconds = 1800;
ini_set('session.gc_maxlifetime', (string) $session_timeout_seconds);
$cookie_params = session_get_cookie_params();
if (PHP_VERSION_ID >= 70300) {
    session_set_cookie_params([
        'lifetime' => $session_timeout_seconds,
        'path' => $cookie_params['path'],
        'domain' => $cookie_params['domain'],
        'secure' => $cookie_params['secure'],
        'httponly' => $cookie_params['httponly'],
        'samesite' => isset($cookie_params['samesite']) ? $cookie_params['samesite'] : 'Lax',
    ]);
} else {
    $cookie_path = $cookie_params['path'] . '; samesite=Lax';
    session_set_cookie_params(
        $session_timeout_seconds,
        $cookie_path,
        $cookie_params['domain'],
        $cookie_params['secure'],
        $cookie_params['httponly']
    );
}

if (session_status() !== PHP_SESSION_ACTIVE) {
    session_start();
}

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $session_timeout_seconds) {
    session_unset();
    session_destroy();
    session_start();
}

$_SESSION['last_activity'] = time();

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
        $request_uri = $_SERVER['REQUEST_URI'] ?? '';
        $request_path = parse_url($request_uri, PHP_URL_PATH);
        if (!is_string($request_path)) {
            $request_path = '';
        }
        $request_path = str_replace('\\', '/', $request_path);

        if (preg_match('#^(.+?)/(admin|pages|functions)(?:/|$)#', $request_path, $matches) === 1) {
            $base_href = rtrim($matches[1], '/') . '/';
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
    }

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