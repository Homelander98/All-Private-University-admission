<?php

require_once __DIR__ . '/core/boot.php';

// Basic ass routing
$uri = trim($_SERVER['REQUEST_URI']);

$scriptName = dirname($_SERVER['SCRIPT_NAME']);

if (strpos($uri, $scriptName) === 0) {
    $uri = substr($uri, strlen($scriptName));
}

$path = explode('?', $uri, 2);
$path = trim($path[0], '/');



$GLOBALS['__current_route'] = "/{$path}";


// Hardcoded home route
if (empty($path)) {
    $routePath = 'home/index.php';
} else {
    $nestedPaths = explode('/', $path);
    $pathCount = count($nestedPaths);
    $routePath = $pathCount === 1 ? "{$path}/index.php" : "{$path}.php";
}

$absPath = ROUTES_PATH . '/' . $routePath;


if (!is_file($absPath)) {
    $absPath = ROUTES_PATH . '/error/404.php';
}

require($absPath);
