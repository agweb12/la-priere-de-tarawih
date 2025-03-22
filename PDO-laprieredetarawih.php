<?php

class Database
{
    private static $dbHost = "91.216.107.186";
    private static $dbName = "lapri2034657";
    private static $dbUser = "lapri2034657";
    private static $dbUserPassword = "Metmati121267@";
    
    private static $connection = null;

    public static function connect()
    {
        try {
            self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName . ";charset=UTF8", self::$dbUser,self::$dbUserPassword, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        } catch (PDOException $th) {
            die($th->getMessage());
        }
        return self::$connection;
    }
    
    public static function disconnect()
    {
        self::$connection = null;
    }
}

Database::connect();

?>