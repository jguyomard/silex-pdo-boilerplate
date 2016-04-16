<?php

// PHP built-in server: let the server handle the request as-is for static files
if (php_sapi_name() === 'cli-server' && is_file(__DIR__.parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH))) {
    return false;
}

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$env = getenv('APP_ENV') ?: 'prod';

require __DIR__.'/../src/app.php';
require __DIR__.'/../config/'.$env.'.config.php';
require __DIR__.'/../src/routes.php';

$app->run();