<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd\core\tests;

/**
 * Description of DatabaseTest
 *
 * @author Luca
 */

class DatabaseTest extends \PHPUnit_Extensions_Database_TestCase {

    /** @var object Database: This is the object that will be tested * */
    protected $object;

    /** @var void $conn: only instantiate PHPUnit_Extensions_Database_DB_IDatabaseConnection once per test * */
    private $conn = null;

    private $config = [];

    private $options = [];

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }

    public function __construct() {

    $this->options = [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING];  
    $this->config = ['database' => [
        'HOST' => 'localhost',
        'NAME' => 'shop',
        'USERNAME' => 'root',
        'PASSWORD' => '']];
    }

    public function testConstruct() {

        $registry = $this->getMockBuilder('\Acd\Registry')
            ->disableOriginalConstructor()
            ->getMock();

        $registry->set('config', $this->config);
  		
        $reflection_class = new \ReflectionClass("\Acd\Database");
        $property = $reflection_class->getProperty('registry');
        $property->setAccessible(true);
        $this->object = new \Acd\Database($registry);
        $this->assertInstanceOf('\Acd\Registry', $registry);
    }

    /**
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection
     */
    protected function getConnection() {
        if ($this->conn === null)
        {
                $instance = new \PDO('mysql:dbname=shop;host=localhost', 'root', '', $this->options);
                $this->conn = $this->createDefaultDBConnection($instance, 'shop');
        }

        return $this->conn;
    }

    /**
     * @return \PHPUnit_Extensions_Database_DataSet_MysqlXmlDataSet
     */
    protected function getDataSet() {
        return $this->createMySQLXMLDataSet(__DIR__ . '/datasource/mysqldump.xml');
    }

    /**
     * This is here to ensure that the database is working correctly
     */
    public function testDatabase() {

        $this->getConnection()->createDataSet(array('products'));

        $queryTable = $this->getConnection()->createQueryTable('products', 'SELECT * FROM products');
        $expectedTable = $this->getDataSet()->getTable('products');
        //Here we check that the table in the database matches the data in the XML file
        $this->assertTablesEqual($expectedTable, $queryTable);
    }

    public function testConnection() { 
        $registry = $this->getMockBuilder('\Acd\Registry')
            ->disableOriginalConstructor()
            ->getMock();

        $registry->set('config', $this->config);
 
        $this->object = new \Acd\Database($registry);
        $this->assertInstanceOf('\Acd\Database', $this->object);
    }

    public function testDisconnect() {

        $registry = $this->getMockBuilder('\Acd\Registry')
            ->disableOriginalConstructor()
            ->getMock();

        $registry->set('database', $this->config);
  		
        $database = new \Acd\Database($registry);
        $this->assertNotInstanceOf('PDO', $database->disconnect());
        $this->assertNull($database->disconnect());
    }

    /**
     * @expectedException \PDOException 
     */
    public function testConnectionException() {
      
        $registry = $this->getMockBuilder('\Acd\Registry')
            ->disableOriginalConstructor()
            ->getMock();

        $registry->set('database', $this->config);
		
        $database = new \Acd\Database($registry);
        return $database->connect();
    }
}