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

    /** @var Database|null **/
    private static $conn = null;
    
    /** @var array $db **/
    private $db = array();

    private function __construct() {}
    
    private function __clone() {}

    /**
     * Connects to the database
     * @param \acd\Registry $registry
     * @return Database
     */
    public static function connect(Registry $registry)
    {
        // One connection through whole application
        if (null == self::$conn) {
            try {
                // Then load the database connection parameters, ...
                $db = $registry->get('config')['database'];
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

}
