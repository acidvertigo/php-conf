<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RegistryTest
 *
 * @author Luca
 */
require_once 'core/Registry.php';

class RegistryTest extends \PHPUnit_Framework_TestCase
{    
    public function testgetInstance()
    {
        $firstCall = \acd\Registry::getInstance();
        $this->assertInstanceOf('\acd\Registry', $firstCall);
        $secondCall = \acd\Registry::getInstance();
        $this->assertSame($firstCall, $secondCall);
    }
    
    public function testNoConstructor()
    {
        $obj = \acd\Registry::getInstance();
        $refl = new \ReflectionObject($obj);
        $meth = $refl->getMethod('__construct');
        $this->assertTrue($meth->isPrivate());
    }
 
}
