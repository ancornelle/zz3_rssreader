<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 11/02/2015
 * Time: 17:07
 */

    require_once __DIR__.'/../vendor/autoload.php';

    $app = new Silex\Application();

    // ... definitions
//    $app->get('/hello/{name}', function($name) use($app) {
//        return 'Hello !!! '.$app->escape($name);
//    });

//    $app->get('/index.php');

//    $app->run();