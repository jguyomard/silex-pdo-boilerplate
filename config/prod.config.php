<?php

$app['debug'] = false;

// PDO
$app['db'] = 'pdo';

$app['pdo.server'] = [
    'driver' => 'mysql',
    'host' => 'localhost',
    'dbname' => 'silex_boilerplate',
    'port' => 3306,
    'user' => 'foo',
    'password' => 'bar',
];

$app['pdo.options'] = [
    // optional PDO attributes used in PDO constructor 4th argument driver_options
    // see http://www.php.net/manual/fr/pdo.construct.php
    \PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
];

$app['pdo.attributes'] = [
    // optional PDO attributes set with PDO::setAttribute
    // see http://www.php.net/manual/fr/pdo.setattribute.php
    \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
];

// Twig
$app['twig.path'] = __DIR__.'/../src/Template/views/';

$app['twig.options'] = [
    'cache' => __DIR__.'/../var/cache/twig/',
    'strict_variables' => true,
    'debug' => false,
    'autoescape' => true,
];

// App
$app['app.blog'] = [
    'articlesPerPage' => 10,
];

