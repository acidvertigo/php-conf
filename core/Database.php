<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace acd;

/**
 * Description of database
 *
 * @author Acidvertigo
 */
class Database 
{

    /** @var object|null Database instance */
    private static $conn = null;
    
    /** @var array $db: database configuration array */
    private $db = array();

    private function __construct() {}
    
    private function __clone() {}
    
    private function __wakeup() {}

    /**
     * Connects to the database
     * @param \acd\Registry $registry
     * @return null|object
     */
    public static function connect(array $registry)
    {
        // One connection through whole application
        if (null == self::$conn) {
            try {
                $options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);

                // Starts connection
                self::$conn = new \PDO("mysql:host=".$registry['HOST'].";dbname=".$registry['NAME'], $registry['USERNAME'], $registry['PASSWORD'], $options);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$conn;
    }

    /**
     * Close database connection
     */
    public static function disconnect()
    {
        self::$conn = null;
    }

}
