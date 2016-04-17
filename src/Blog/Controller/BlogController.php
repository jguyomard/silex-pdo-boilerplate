<?php

namespace Blog\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class BlogController
{
    public function indexAction(Application $app)
    {
        $articles = $app['repository.article']->findAll($app['app.blog']['articlesPerPage']);
        dump($articles);

        return $app['twig']->render('@Blog/article-list.html.twig', [
            'articles' => $articles,
        ]);
    }

    public function articleAction(Request $request, Application $app)
    {
        $article = $request->attributes->get('article');
        if (empty($article)) {
            $app->abort(404, 'The requested article was not found.');
        }

        return $app['twig']->render('@Blog/article-page.html.twig', [
            'article' => $article,
        ]);
    }

    public function apiAction(Request $request, Application $app)
    {
        return $app->json([
            'foo' => 'bar',
        ]);
    }
}
