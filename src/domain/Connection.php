<?php
/**
 * Created by PhpStorm.
 * User: adpourcher1
 * Date: 06/03/2015
 * Time: 14:36
 */


class Connection {

    const DB_NAME = "rssbdd";

    const DB_USER = "root";

    const DB_PASS = "";

    const DB_HOST = "localhost";

    private static $pdo = null;

    public static function getPDO()
    {
        if ( null === self::$pdo)
        {
            self::$pdo = new PDO('mysql:host='.self::DB_HOST.';dbname='.self::DB_NAME, self::DB_USER, self::DB_PASS);
        }
        return self::$pdo;
    }
}