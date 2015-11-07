<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd\core\tests;

/**
 * Description of Configloader
 *
 * @author Luca
 */

class ConfigTest extends \PHPUnit_Framework_TestCase
{

    private $path = 'include/config.php';
    private $wrongPath = 'include/conffig.php';
	
    public function setUp() { 
            $_SERVER['HTTP_HOST'] = 'localhost'; 
        } 
  
        public function tearDown() {  
            unset($_SERVER['HTTP_HOST']);
            parent::tearDown();  
        } 
 
    /**
     * @expectedException \Exception 
     * @return array Configuration array
     */
    public function testLoadconfigException()
    {
        $loadconfig = new \Acd\Config($this->wrongPath);
        return $loadconfig->loadconfig();
    }

    public function testLoadconfig()
    {
        $loadconfig = new \Acd\Config($this->path);
        $this->assertAttributeInternalType('array', 'data', $loadconfig);
        $this->assertArrayHasKey('database', $loadconfig->loadconfig());
        $this->assertArrayHasKey('test', $loadconfig->loadconfig());
    }
}
