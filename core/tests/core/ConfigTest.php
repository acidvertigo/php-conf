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
	private $filesystem;
	private $container;
	
    public function setUp() { 
          
			$this->container = new \Acd\Container;
			$this->filesystem = $this->container->resolve('\Acd\FileSystem', [$this->path], FALSE);
        } 
  
        public function tearDown() {  
          
            parent::tearDown();  
        } 
 
    /**
     * @expectedException \Exception 
     * @return array Configuration array
     */
    public function testLoadconfigException()
    {
        $file = $this->container->resolve('\Acd\FileSystem', [$this->wrongPath], FALSE);
		$config = $this->container->resolve('\Acd\Config', [$file]);
        return $config->loadconfig();
    }

    public function testLoadconfig()
    {
        $config = $this->container->resolve('\Acd\Config', [$this->filesystem]);
        $this->assertAttributeInternalType('array', 'data', $config);
        $this->assertArrayHasKey('database', $config->loadconfig());
        $this->assertArrayHasKey('test', $config->loadconfig());
    }
}
