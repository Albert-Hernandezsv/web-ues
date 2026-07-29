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

if (str_starts_with($_SERVER['REQUEST_URI'] ?? '', '/web-ues')
    && str_contains($_SERVER['SCRIPT_NAME'] ?? '', '/web-ues/public/index.php')) {
    $_SERVER['SCRIPT_NAME'] = '/web-ues/index.php';
}

// Bootstrap Laravel and handle the request...
/** @var Application $app */
$app = require_once __DIR__.'/../bootstrap/app.php';

$app->handleRequest(Request::capture());
