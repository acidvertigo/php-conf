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

    /** @var \PDO * */
    static private $pdo = null;

    private $options = [];
	
	private $container;
	private $config;
	private $path = 'include/config.php';

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        $this->container = new \Acd\Container;
		$this->filesystem = $this->container->resolve('\Acd\FileSystem', [$this->path]);
		$this->config = $this->container->resolve('\Acd\Config', [$this->filesystem]);
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

        $this->object = new \Acd\Database($this->config);
       
    }

    /**
     * @return \PHPUnit_Extensions_Database_DB_DefaultDatabaseConnection|null
     */
    protected function getConnection() {
        if ($this->conn === null)
        {
            if (self::$pdo == null)
            {
                self::$pdo = new \PDO('mysql:dbname=shop;host=localhost', 'root', '', $this->options);
            }	
                $this->conn = $this->createDefaultDBConnection(self::$pdo, 'shop');
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
        $registry = $this->config;

        $config = $registry->loadconfig();

        $object = new \Acd\Database($config);
        $this->assertInstanceOf('\Acd\Database', $object);
    }

    public function testDisconnect() {
        $object = new \Acd\Database($this->filesystem);
        $this->assertNotInstanceOf('PDO', $database->disconnect());
        $this->assertNull($database->disconnect());
    }

    /**
     * @expectedException \PDOException 
     */
    public function testConnectionException() {

      $configure = ['database' => [
        'HOST' => 'localhost',
        'NAME' => 'shopshop',
        'USERNAME' => 'roottoor',
        'PASSWORD' => '']];
	  
        $config = $reflection = new \ReflectionClass($this->config);
		
		$property = $config->getProperty('data');
		$property->setAccessible(true);
		$property->setValue($this->config, $configure);
 
        $object = new \Acd\Database($config);
        return $database->connect();
    }
}