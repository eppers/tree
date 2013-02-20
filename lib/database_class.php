<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of database_class
 *
 * @author Peter
 */
class database {
    protected static $dbhost="localhost";
    protected static $dbuser="root";
    protected static $dbpass="";//pGPFbhIg
    protected static $dbname="petre_jamam";
    
    public static function getConnection() {
        $dbh = new PDO("mysql:host=".self::$dbhost.";dbname=".self::$dbname.", ".self::$dbuser.",".self::$dbpass);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $dbh;
    }
}

?>
