<?php
/**
 * Created by PhpStorm.
 * User: Antoine
 * Date: 11/02/2015
 * Time: 17:24
 */

require_once __DIR__.'/../view/PhpTemplateEngine.php';

class EntryController
{
    public function listEntry()
    {
        $entry = new Entry();
        $entries = $entry->findAll(Connection::getPDO());
        $categories = $entry->findAllCategory(Connection::getPDO());
        $engine = new PhpTemplateEngine(__DIR__.'/../view/');

        echo $engine->render('EntryList.html',['engine' => $engine, 'entries' => $entries, 'categories' => $categories]);

    }
}