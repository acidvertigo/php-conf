<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
 * Description of ContainerTest,php
 *
 * @author Luca
 */
class ContainerTest extends \PHPUnit_Framework_TestCase {

public function testAdd()
{
	$container = new \Acd\Container;
	$container->add("integer", 1);
	$container->add("string", 'value');
	$container->add("array", array(1,2,3));
	$container->add("object",function()
	{
		return Acd\Registry::getInstance();
	});
	
	
	$result = $container->make('integer');
    $this->assertInternalType('integer', $result);
	
	$result = $container->make('string');
    $this->assertInternalType('string', $result);
	
	$result = $container->make('array');
    $this->assertInternalType('array', $result);
	
	$result = $container->make('object');
    $this->assertInternalType('object', $result);

}

}
