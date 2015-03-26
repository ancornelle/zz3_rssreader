<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 11/02/2015
 * Time: 17:07
 */

    require_once __DIR__.'/../vendor/autoload.php';
    require_once __DIR__.'/../src/domain/Entry.php';
    require_once __DIR__.'/../src/domain/Feed.php';
    require_once __DIR__.'/../src/domain/Connection.php';
    require_once __DIR__.'/../src/view/PhpTemplateEngine.php';
    require_once __DIR__.'/../src/crawler/Crawler.php';

    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;
    use Silex\Application;

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->post('/addFeed', function (Request $request) use ($app)
    {
        $feed = $request->get("inputRss");
        $type = $request->get("inputType");
        if (false === !filter_var($feed, FILTER_VALIDATE_URL))
        {
            if ('Atom' === $type)
                parseAtomByEntry($app->escape($feed));
            else
                parseRSSByEntry($app->escape($feed));
        }
        if (!$c = Connection::getPDO())
        {
            $app->abort(500, "No Database found.");
        }
        if (null === $request->headers->get('Accept') || "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8" === $request->headers->get('Accept'))
        {
            return $app->redirect('/');
        }
        else
        {
            $e = new Entry();
            return new $app->json($e->findAll($c),201);
        }
    });

    $app->get('/', function(Silex\Application $app, Request $request)
    {
        if (!$c = Connection::getPDO())
        {
            $app->abort(500, "No Database found.");
        }
        $f = new Feed();
        $feeds = $f->findAll($c);
        foreach ($feeds as $f)
        {
            if ('Atom' === $f['feedType'])
            {
                parseAtomByEntry($f['feedUrl']);
            }
            else
            {
                parseRSSByEntry($f['feedUrl']);
            }
        }
        $e = new Entry();
        if (null === $request->headers->get('Accept') || "text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8" === $request->headers->get('Accept'))
        {
            $entries = $e->findAll($c);
            $categories = $e->findAllCategory($c);
            $engine = new PhpTemplateEngine(__DIR__ . '/../src/view/');

            return new Response($engine->render('EntryList.html', ['engine' => $engine, 'entries' => $entries, 'categories' => $categories]), 200);
        }
        else
        {
            return new $app->json($e->findAll($c), 200);
        }
    });

    $app->run();