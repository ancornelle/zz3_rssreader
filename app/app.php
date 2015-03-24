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
    require_once __DIR__.'/../src/controller/EntryController.php';

//    $app = new Silex\Application();

    // ... definitions
//    $app->get('/hello/{name}', function($name) use($app) {
//        return 'Hello !!! '.$app->escape($name);
//    });

//    $app->get('/index.php');

//    $app->run();

    $app = new Silex\Application();

    $app['debug'] = true;

    $app->get('/',function(){
        $ec = new EntryController();
        return $ec->listEntry();
    });

    $app->get('/api', function(Silex\Application $app){
        $e = new Entry();
        if (!$c = Connection::getPDO())
        {
            $app->abort(500, "No Database found.");
        }
        if (!$e->findAll($c))
        {
            $app->abort(404, "No items found.");
        }
        return json_encode($e->findAll($c));
    });

    $app->post('/api/{url}', function (Silex\Application $app, $url){
        $f = new Feed();
        if (!isset($url))
        {
            $app->abort(404, "Specified URL is empty.");
        }
        $f->feedUrl = $url;
        if (!$c = Connection::getPDO())
        {
            $app->abort(500, "No Database found.");
        }

        return $f->save($c);
    });

    $app->run();