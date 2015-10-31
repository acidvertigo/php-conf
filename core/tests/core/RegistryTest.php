<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd\core\tests;

/**
 * Description of RegistryTest
 *
 * @author Luca
 */

class RegistryTest extends \PHPUnit_Framework_TestCase
{

    public function testGet()
    {
        $array = [1, 2, 3];

        $registry = new \Acd\Registry;
        $registry->set('test', $array);

        $result = $registry->get('test');
        $this->assertInternalType('array', $result);
        $this->assertContains('1', $result);
        $this->assertContains('2', $result);
        $this->assertContains('3', $result);
    }

    public function testRemove()
    {
        $registry = new \Acd\Registry;
        $registry->set('test3', 'data');
        $registry->remove('test3');
        $this->assertArrayNotHasKey('test3', $registry);
    }

    public function testReset()
    {
        $registry = new \Acd\Registry;
        $this->assertNull($registry->reset());
    }

    public function testIsEmpty()
    {
       $registry = new \Acd\Registry;
       $registry->set('data', 'test');
       $this->assertFalse($registry->isEmpty('data'));
       $this->assertTrue($registry->isEmpty('data2'));
    }

    /**
     * @expectedException \Exception 
     */
    public function testGetException()
    {
        $registry = new \Acd\Registry;
        $registry->set('test', array(1, 2, 3));
        return $registry->get('foo');
    }

    /**
     * @expectedException \Exception 
     */
    public function testSetException()
    {
        $registry = new \Acd\Registry;
        $registry->set('test', array(1, 2, 3));
        return $registry->set('test', array(1, 2, 3));
    }

    public function testArrayAccess()
    {
        $registry = new \Acd\Registry;
        $property = 'foo';
        $value = 'bar';
        $array = array('foo' => 'bar');
        $registry[$property] = $value;
        $this->assertEquals($array[$property], $registry[$property]);
        $this->assertAttributeInternalType('array', 'data', $registry);
    }

    public function testArrayAccessExists()
    {
        $registry = new \Acd\Registry;
        $registry->set('test1', array(1, 2, 3));
        $this->assertTrue(isset($registry['test1']));
    }

    public function testArrayAccessUnset()
    {
        $registry = new \Acd\Registry;
        $registry->set('test2', array(1, 2, 3));
        unset($registry['test2']);
        $this->assertFalse(isset($registry['test2']));
    }
}
