<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * ConnectionTest class copied from Connection class with reference to test database
 */
class ConnectionTest {

    const DB_NAME = "rssbdd_test";

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