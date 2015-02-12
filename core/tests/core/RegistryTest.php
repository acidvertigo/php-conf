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
    
    public function testget()
    {
        $registry = \acd\Registry::getInstance();
        $registry->set('test', array(1, 2, 3));
        
        $result = $registry->get('test');
        $this->assertInternalType('array', $result);
        $this->assertContains('1', $result);
        $this->assertContains('2', $result);
        $this->assertContains('3', $result);
    }

    
    public function testConstruct()
    {
        $obj  = \acd\Registry::getInstance();
        $refl = new \ReflectionObject($obj);
        $meth = $refl->getMethod('__construct');
        $this->assertTrue($meth->isPrivate());
    }
}
