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

class RegistryTest extends \PHPUnit_Framework_TestCase
{
    
    public function testget()
    {
        $registry = new Acd\Registry;
        $registry->set('test', array(1, 2, 3));
        
        $result = $registry->get('test');
        $this->assertInternalType('array', $result);
        $this->assertContains('1', $result);
        $this->assertContains('2', $result);
        $this->assertContains('3', $result);
    }
    
        public function testReset()
    {
        $registry = new Acd\Registry;
        $this->assertNull($registry->reset());
    }
    
    /**
     * @expectedException \Exception 
     */
    public function testGetException()
    {
        $registry = new Acd\Registry;
        $registry->set('test', array(1, 2, 3));
        return $registry->get('config');
    }
	
    /**
     * @expectedException \Exception 
     */
    public function testSetException()
    {
        $registry = new Acd\Registry;
        $registry->set('test', array(1, 2, 3));
        return $registry->set('test', array(1, 2, 3));
    }
    
    public function testArrayAccess()
    {
        $registry = new Acd\Registry;
        $property = 'foo';
        $value = 'bar';
        $array = array('foo' => 'bar');
        $registry[$property] = $value;
        $this->assertEquals($array[$property], $registry[$property]);
    }

    public function testArrayAccessExists()
    {
        $registry = new Acd\Registry;
        $registry->set('test1', array(1, 2, 3));
        $this->assertTrue(isset($registry['test1']));
    }

    public function testArrayAccessUnset()
    {
        $registry = new Acd\Registry;
        $registry->set('test2', array(1, 2, 3));
        unset($registry['test2']);
        $this->assertFalse(isset($registry['test2']));
    }
}
