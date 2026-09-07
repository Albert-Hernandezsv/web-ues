<?php

use Illuminate\Foundation\Application;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Determine if the application is in maintenance mode...
if (file_exists($maintenance = __DIR__.'/../storage/framework/maintenance.php')) {
    require $maintenance;
}

// Register the Composer autoloader...
require __DIR__.'/../vendor/autoload.php';

foreach (['/web-ues', '/ues'] as $basePath) {
    if (str_starts_with($_SERVER['REQUEST_URI'] ?? '', $basePath)
        && str_contains($_SERVER['SCRIPT_NAME'] ?? '', $basePath.'/public/index.php')) {
        $_SERVER['SCRIPT_NAME'] = $basePath.'/index.php';
        break;
    }
}

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
