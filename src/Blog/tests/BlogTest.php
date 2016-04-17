<?php

use Silex\WebTestCase;

class BlogTest extends WebTestCase
{
    public function testHomepage()
    {
        $client = $this->createClient();
        $client->followRedirects(true);
        $crawler = $client->request('GET', '/');

        $this->assertTrue($client->getResponse()->isOk(), 'isOK');
        $this->assertContains('Hello', $crawler->filter('body')->text());
        $this->assertCount(1, $crawler->filter('h2:contains("Last")'));
        $this->assertCount(2, $crawler->filter('li'));
    }

    public function testArticle()
    {
        $client = $this->createClient();
        $client->followRedirects(true);
        $crawler = $client->request('GET', '/1');

        $this->assertTrue($client->getResponse()->isOk());
        $this->assertContains('Hello', $crawler->filter('body')->text());
        $this->assertCount(1, $crawler->filter('h2:contains("Foo")'));
    }

    public function createApplication()
    {
        $app = new Silex\Application();
        $env = 'dev';

        !defined('ROOT') && define('ROOT', __DIR__.str_repeat(DIRECTORY_SEPARATOR.'..', 3));

        require ROOT.'/src/app.php';
        require ROOT.'/config/'.$env.'.config.php';
        require ROOT.'/src/routes.php';

        // Load DB ?
        if (getenv('DB_USER') !== false && getenv('DB_PASS') !== false) {
            $app['pdo.server'] = array_merge($app['pdo.server'], [
                'user' => getenv('DB_USER'),
                'password' => getenv('DB_PASS'),
            ]);
            $app['pdo']->exec(file_get_contents(ROOT.'/boilerplate.sql'));
        }

        unset($app['exception_handler']);
        $app['debug'] = true;
        $app['session.test'] = true;

        return $app;
    }
}
