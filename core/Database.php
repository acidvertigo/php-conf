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

    /** @var object|null **/
    private static $conn = null;
    
    /** @var array $db **/
    private $db = array();

    private function __construct() {}
    
    private function __clone() {}
    
    private function __wakeup() {}

    /**
     * Connects to the database
     * @param \acd\Registry $registry
     * @return null|object
     */
    public static function connect(Registry $registry)
    {
        // One connection through whole application
        if (null == self::$conn) {
            try {
                // Load the database connection parameters from the Registry
                $db = $registry->get('config')['database'];

                // Starts connection
                self::$conn = new \PDO("mysql:host=".$db['HOST'].";dbname=".$db['NAME'], $db['USERNAME'], $db['PASSWORD']);
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
    
    public static function reset() {
        self::$conn = null;
    }

}
