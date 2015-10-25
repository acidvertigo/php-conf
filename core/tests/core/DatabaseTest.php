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

    public function testConstruct() {
        
        $config = ['database' => [
        'HOST' => 'localhost',
        'NAME' => 'shop',
        'USERNAME' => 'root',
        'PASSWORD' => '']];
		
        $reflection_class = new \ReflectionClass("\Acd\Database");
        $property = $reflection_class->getProperty('registry');
        $property->setAccessible(true);
        $object = new \Acd\Database($config);
        $this->assertEquals($config, $property->getValue($object));
    }

    /**
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection|null
     */
    protected function getConnection() {
        if ($this->conn === null) {       
                $options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);  
                $instance = new \PDO('mysql:dbname=shop;host=localhost', 'root', '', $options);
                $this->conn = $this->createDefaultDBConnection($instance, 'shop');
        }

        return $this->conn;
    }

    /**
     * @return \PHPUnit_Extensions_Database_DataSet_MysqlXmlDataSet
     */
    protected function getDataSet() {
        return $this->createMySQLXMLDataSet(__DIR__.'/datasource/mysqldump.xml');
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

            $options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);

            $config = array('HOST' => 'localhost',
                                'NAME' => 'shop',
                                'USERNAME' => 'root',
                                'PASSWORD' => '',
                                $options);
                               
            $database = new \Acd\Database();
            $reflection = new \ReflectionClass($database);
            $property = $reflection->getProperty('registry');
            $property->setAccessible(true);
            $property->setValue($database, $config);
                                                         
            $this->object = $database->connect();

            $this->assertInstanceOf('PDO', $this->object);
        }

    public function testDisconnect() {
        $database = new \Acd\Database;
        $this->assertNotInstanceOf('PDO', $database->disconnect());
        $this->assertNull($database->disconnect());
    }

    /**
     * @expectedException \Exception 
     */
    public function testConnectionException() {
        $options = array(\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ, \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING);
		
		$config = array('HOST' => 'localhost',
                        'NAME' => 'shopshop',
                        'USERNAME' => 'rootroot',
                        'PASSWORD' => 'root',
                        $options);
		
		$database = new \Acd\Database($config);
		$database->connect();

    }
}
