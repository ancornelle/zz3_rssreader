<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 26/03/2015
 * Time: 14:47
 */

require_once __DIR__.'ConnectionTest.php';

class DAOEntryTest extends PHPUnit_Framework_TestCase
{
    public function testFindAllEntry()
    {
        $e = new Entry();
        $e->entryId = 'id';
        $e->$entryTitle = 'title';
        $e->$entryFeed = 'Google Top Stories';
        $e->$entryCategory = 'Top Stories';
        $e->$entryContent = 'content';
        $e->entryUpdatedDate = '0000-00-00';
        $e->entryUrl = 'http://url';

        $e->save(ConnectionTest::getPDO());
        $array = $e->findAll(ConnectionTest::getPDO());
        $this->assertEquals(1, count($array));

        $e->delete(ConnectionTest::getPDO());
    }

    public function testInsertEntry()
    {
        $e = new Entry();

        $array = $e->findAll(ConnectionTest::getPDO());
        $this->assertEquals(0, count($array));

        $e->entryId = 'id';
        $e->$entryTitle = 'title';
        $e->$entryFeed = 'Google Top Stories';
        $e->$entryCategory = 'Top Stories';
        $e->$entryContent = 'content';
        $e->entryUpdatedDate = '0000-00-00';
        $e->entryUrl = 'http://url';

        $e->save(ConnectionTest::getPDO());
        $array = $e->findAll(ConnectionTest::getPDO());
        $this->assertEquals(1, count($array));

        $e->delete(ConnectionTest::getPDO());
    }

    public function testUpdateEntry()
    {
        $e = new Entry();
        $e->entryId = 'id';
        $e->$entryTitle = 'title';
        $e->$entryFeed = 'Google Top Stories';
        $e->$entryCategory = 'Top Stories';
        $e->$entryContent = 'content';
        $e->entryUpdatedDate = '0000-00-00';
        $e->entryUrl = 'http://url';

        $e->save(ConnectionTest::getPDO());

        $e->entryId = 'id';
        $e->$entryTitle = 'title';
        $e->$entryFeed = 'Google Top Stories';
        $e->$entryCategory = 'Top Stories';
        $e->$entryContent = 'content_different';
        $e->entryUpdatedDate = '0000-00-01';
        $e->entryUrl = 'http://url';

        $e->save(ConnectionTest::getPDO());
        $array = $e->findAll(ConnectionTest::getPDO());
        $this->assertEquals(1, count($array));

        $e->delete(ConnectionTest::getPDO());
    }

    public function testDeleteEntry()
    {
        $e = new Entry();
        $e->entryId = 'id';
        $e->$entryTitle = 'title';
        $e->$entryFeed = 'Google Top Stories';
        $e->$entryCategory = 'Top Stories';
        $e->$entryContent = 'content';
        $e->entryUpdatedDate = '0000-00-00';
        $e->entryUrl = 'http://url';

        $e->save(ConnectionTest::getPDO());
        $array = $e->findAll(ConnectionTest::getPDO());
        $this->assertEquals(1, count($array));

        $e->delete(ConnectionTest::getPDO());
        $array = $e->findAll(ConnectionTest::getPDO());
        $this->assertEquals(0, count($array));
    }
}