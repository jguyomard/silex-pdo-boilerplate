<?php

require_once __DIR__.'/../vendor/autoload.php';

$app = new Silex\Application();
$env = getenv('APP_ENV') ?: 'prod';

require __DIR__.'/../src/app.php';
require __DIR__.'/../config/'.$env.'.config.php';
require __DIR__.'/../src/routes.php';

$app->run();