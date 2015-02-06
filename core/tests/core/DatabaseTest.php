<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatabaseTest
 *
 * @author Luca
 */
require_once 'core/Database.php';
require_once 'core/Registry.php';

class DatabaseTest extends \PHPUnit_Extensions_Database_TestCase
{

    /**
     * This is the object that will be tested
     * @var object Database
     */
    protected $object;

    /**
     * only instantiate pdo once for test clean-up/fixture load
     * @var void PDO
     */
    static private $pdo = null;

    /**
     * only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test
     * @var void $conn 
     */
    private $conn = null;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $registry = acd\Registry::getInstance();
        $registry->set('config', array('database' => array('HOST' => 'localhost', 
                                                           'NAME' => 'shop', 
                                                           'USERNAME' => 'root',
                                                           'PASSWORD' =>'' )));
        $this->object = acd\Database::connect($registry);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    protected function getConnection()
    {
        if ($this->conn === null) {
            if (self::$pdo == null) {
                self::$pdo = new PDO('mysql:dbname=shop;host=localhost', 'root', '');
            }
            $this->conn = $this->createDefaultDBConnection(self::$pdo, 'ross_testing');
        }
        return $this->conn;
    }

    protected function getDataSet()
    {
        return $this->createMySQLXMLDataSet(__DIR__ . '/datapump.xml');
    }

    /**
     * This is here to ensure that the database is working correctly
     */
    public function testDataBaseConnection()
    {

        $this->getConnection()->createDataSet(array('products'));
        $prod = $this->getDataSet();
        $queryTable = $this->getConnection()->createQueryTable(
                'products', 'SELECT * FROM products'
        );
        $expectedTable = $this->getDataSet()->getTable('products');
        //Here we check that the table in the database matches the data in the XML file
        $this->assertTablesEqual($expectedTable, $queryTable);
    }

}
