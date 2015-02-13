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

class DatabaseTest extends \PHPUnit_Extensions_Database_TestCase
{

    /** @var object Database: This is the object that will be tested **/
    protected $object;

    /** @var object PDO: only instantiate pdo once for test clean-up/fixture load **/
    static private $instance = null;

    /** @var void $conn: only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test **/
    private $conn = null;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        
    }

    /**
     * @return PHPUnit_Extensions_Database_DB_IDatabaseConnection
     */
    protected function getConnection()
    {
        if ($this->conn === null) {
            if (self::$instance === null) {
                $options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);
                self::$instance = new PDO('mysql:dbname=shop;host=localhost', 'root', '', $options);
            }
            $this->conn = $this->createDefaultDBConnection(self::$instance, 'shop');
        }
        return $this->conn;
    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    protected function getDataSet()
    {
        return $this->createMySQLXMLDataSet(__DIR__.'/datasource/mysqldump.xml');
    }

    /**
     * This is here to ensure that the database is working correctly
     */
    public function testDataBaseConnection()
    {

        $this->getConnection()->createDataSet(array('products'));
        $prod          = $this->getDataSet();
        $queryTable    = $this->getConnection()->createQueryTable('products', 'SELECT * FROM products');
        $expectedTable = $this->getDataSet()->getTable('products');
        //Here we check that the table in the database matches the data in the XML file
        $this->assertTablesEqual($expectedTable, $queryTable);
    }
    
    public function testDisconnect()
    {
        $this->assertNull($this->conn);
    }
}
