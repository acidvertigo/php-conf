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

class ConfigloaderTest extends \PHPUnit_Framework_TestCase
{

    private $path = 'include/config.php';
    private $wrongFile = 'include/conffig.php';
    private $wrongPath = 'iinclude/config.php';
	
    
    public function testConstruct()
    {
        $reflection_class = new \ReflectionClass('\Acd\Configloader');
        $property = $reflection_class->getProperty('path');
        $property->setAccessible(true);
        $object = new \Acd\Configloader($this->path);
        $this->assertEquals($this->path, $property->getValue($object));
    }

    /**
     * @expectedException \Exception 
     * @return array Configuration array
     */
    public function testLoadDirConfigException()
    {
        $loadconfig = new \Acd\Configloader($this->wrongPath);
        return $loadconfig->loadconfig();
    }
	
    /**
     * @expectedException \Exception 
     * @return array Configuration array
     */
    public function testLoadconfigException()
    {
        $loadconfig = new \Acd\Configloader($this->wrongFile);
        return $loadconfig->loadconfig();
    }

    public function testLoadconfig()
    {
        $loadconfig = new \Acd\Configloader($this->path);
        $this->assertFileExists($this->path);
        $this->assertAttributeInternalType('array', 'data', $loadconfig);
    }
}