<?php

require __DIR__.'/prod.config.php';

$app['pdo.server'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'dbname' => 'silex_boilerplate',
    'port' => 3306,
    'user' => 'root',
    'password' => 'root',
];

$app['twig.options'] = [
    'cache' => false,
    'strict_variables' => true,
    'debug' => true,
    'autoescape' => true,
];

// Enable WebDebuger + VarDumper
$app['debug'] = true;

$app->register(new \Silex\Provider\WebProfilerServiceProvider(), array(
    'profiler.cache_dir' => __DIR__.'/../var/cache/profiler',
));
$app->register(new Silex\Provider\DebugServiceProvider(), array(
    'debug.max_items' => 250,
    'debug.max_string_length' => -1,
));

// Logs
$app->register(new \Silex\Provider\MonologServiceProvider(), array(
    'monolog.logfile' => __DIR__.'/../var/logs/silex.dev.log',
));