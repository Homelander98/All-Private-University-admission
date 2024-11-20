<?php

error_reporting(-1);

define("APP_PATH", dirname(__DIR__));

define("TEMPLATE_PATH", APP_PATH . '/templates');

define("CORE_PATH", APP_PATH . '/core');

define('ROUTES_PATH', APP_PATH . '/routes');

define('UPLOADS_DIR', 'uploads');

define('UPLOADS_PATH', APP_PATH . '/' . UPLOADS_DIR);


spl_autoload_register(static function ($class) {
    // project-specific namespace prefix
    $prefix = 'Green\\Library\\';

    // base directory for the namespace prefix
    $baseDir = CORE_PATH . '/lib/';

    // does the class use the namespace prefix?
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        // no, move to the next registered autoloader
        return;
    }

    // get the relative class name
    $relativeClass = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = rtrim($baseDir, '/') . '/' . str_replace('\\', '/', $relativeClass) . '.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});

require CORE_PATH . '/functions.php';

no_cache_headers();
session_start();

// Connect to the database
db();


if (is_logged()) {
    $user = get_logged_user();

    // No valid user? Invalid user id then
    if (!$user) {
        unset($_SESSION['user_id']);
    }
}


if (!isset($_SESSION['_crsf_token'])) {
    $_SESSION['_crsf_token'] = bin2hex(openssl_random_pseudo_bytes(16));
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $crsfToken = $_POST['csrf_token'] ?? null;

    if ($_SESSION['_crsf_token'] !== $crsfToken) {
        fatal_server_error('Invalid Request', 'The request is missing CSRF token or the provided token is invalid. Go back, refresh the page and try again.');
    }
}
