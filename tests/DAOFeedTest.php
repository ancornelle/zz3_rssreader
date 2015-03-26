<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 26/03/2015
 * Time: 14:47
 */

require_once __DIR__.'ConnectionTest.php';

class DAOFeedTest extends PHPUnit_Framework_TestCase
{
    public function testFindAllFeed()
    {
        $f = new Feed();
        $f->feedId = 'title';
        $f->feedTitle = 'title';
        $f->feedUrl = 'link';
        $f->feedUpdatedDate = '0000-00-00';
        $f->feedType = 'RSS';

        $f->save(ConnectionTest::getPDO());
        $array = $f->findAll(ConnectionTest::getPDO());
        $this->assertEquals(1, count($array));

        $f->delete(ConnectionTest::getPDO());
    }

    public function testInsertFeed()
    {
        $f = new Feed();

        $array = $f->findAll(ConnectionTest::getPDO());
        $this->assertEquals(0, count($array));

        $f->feedId = 'title';
        $f->feedTitle = 'title';
        $f->feedUrl = 'link';
        $f->feedUpdatedDate = '0000-00-00';
        $f->feedType = 'RSS';

        $f->save(ConnectionTest::getPDO());
        $array = $f->findAll(ConnectionTest::getPDO());
        $this->assertEquals(1, count($array));

        $f->delete(ConnectionTest::getPDO());
    }

    public function testUpdateFeed()
    {
        $f = new Feed();
        $f->feedId = 'title';
        $f->feedTitle = 'title';
        $f->feedUrl = 'link';
        $f->feedUpdatedDate = '0000-00-00';
        $f->feedType = 'RSS';

        $f->save(ConnectionTest::getPDO());

        $f->feedId = 'title';
        $f->feedTitle = 'title';
        $f->feedUrl = 'link_different';
        $f->feedUpdatedDate = '0000-00-01';
        $f->feedType = 'RSS';

        $f->save(ConnectionTest::getPDO());
        $array = $f->findAll(ConnectionTest::getPDO());
        $this->assertEquals(1, count($array));

        $f->delete(ConnectionTest::getPDO());
    }

    public function testDeleteFeed()
    {
        $f = new Feed();
        $f->feedId = 'title';
        $f->feedTitle = 'title';
        $f->feedUrl = 'link';
        $f->feedUpdatedDate = '0000-00-00';
        $f->feedType = 'RSS';

        $f->save(ConnectionTest::getPDO());
        $array = $f->findAll(ConnectionTest::getPDO());
        $this->assertEquals(1, count($array));

        $f->delete(ConnectionTest::getPDO());
        $array = $f->findAll(ConnectionTest::getPDO());
        $this->assertEquals(0, count($array));
    }
}