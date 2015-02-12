<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Configloader
 *
 * @author Luca
 */

require_once 'core/Configloader.php';


class ConfigloaderTest extends \PHPUnit_Framework_TestCase
{

    public function testConstructor()
    {
        //First we need to create a ReflectionClass object
        //passing in the class name as a variable
        $reflection_class = new ReflectionClass('\acd\Configloader');

        //Then we need to get the property we wish to test
        //and make it accessible
        $property = $reflection_class->getProperty('data');
        $property->setAccessible(true);
        
        $file = 'include/config.ini';
        $this->assertFileExists($file);

        //We need to create an empty object to pass to
        //ReflectionProperty's getValue method
        $config = new \acd\Configloader($file);
        
        $this->assertInternalType('array', $property->getValue($config));

        $this->assertArrayHasKey('database', $property->getValue($config));
        $this->assertArrayHasKey('test', $property->getValue($config));
    }
}
