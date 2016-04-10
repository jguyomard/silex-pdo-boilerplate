<?php

/** @var \Silex\Application $app */


/*
 * Register Service Providers
 */
$app->register(new Csanquer\Silex\PdoServiceProvider\Provider\PDOServiceProvider('pdo'));
$app->register(new Silex\Provider\ServiceControllerServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider());
$app->register(new Silex\Provider\HttpFragmentServiceProvider());

/*
 * Register Repositories
 */
$app['repository.article'] = function ($app) {
    return new \Blog\Repository\ArticleRepository($app['pdo']);
};

/*
 * Extend Twig and Register views paths
 */
$app['twig'] = $app->extend('twig', function ($twig, $app) {
    // add custom globals, filters, tags, ...
    return $twig;
});
$app->extend('twig.loader.filesystem', function ($loader, $app) {
    $loader->addPath(__DIR__ . '/Blog/views', 'Blog');

    return $loader;
});

/*
 * Errors
 */
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

$app->error(function (\Exception $e, Request $request, $error) use ($app) {
    if ($app['debug']) {
        return null;
    }

    // 404.html, 5xx, or default.html
    $templates = [
        'errors/'.$error.'.html.twig',
        'errors/'.substr($error, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    ];

    return new Response(
        $app['twig']->resolveTemplate($templates)->render(['errorCode' => $error]),
        $error
    );
});