<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 26/03/2015
 * Time: 14:18
 */


require_once __DIR__.'ConnectionTest.php';

class DBTest extends PHPUnit_Framework_TestCase
{
    public function testConnection()
    {
        $this->assertNotNull(Connection::getPDO());
    }
}