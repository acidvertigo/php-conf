<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace acd;

require_once 'core/Singleton.php';

/**
 * Description of database
 *
 * @author Acidvertigo
 */
class Database 
{
    use Singleton;

    /**
     * Connects to the database
     * @param array $registry
     * @return null|object
     */
    public static function connect(array $registry)
    {
        // One connection through whole application
        if (!self::$instance) {
            try {
                $options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);

                // Starts connection
                self::$instance = new \PDO("mysql:host=".$registry['HOST'].";dbname=".$registry['NAME'], $registry['USERNAME'], $registry['PASSWORD'], $options);
            } catch (\PDOException $e) {
                echo $e->getMessage();
            }
        }
        
        return self::$instance;
    }

    /**
     * Close database connection
     */
    public static function disconnect()
    {
        self::$instance = null;
    }

}
