<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DatabaseTest
 *
 * @author Luca
 */
require_once 'core/Database.php';
require_once 'core/Registry.php';

class DatabaseTest extends \PHPUnit_Framework_TestCase
{    
    public function testconnect()
    {
        $registry = \acd\Registry::getInstance();
        
        $registry->set('config', array('database' => array('HOST' => 'localhost', 
                                                           'NAME' => 'shop', 
                                                           'USERNAME' => 'root',
                                                           'PASSWORD' =>'' )));
        
        $firstCall = \acd\Database::connect($registry);
        $this->assertInstanceOf('\PDO', $firstCall);
        $secondCall = \acd\Database::connect($registry);
        $this->assertSame($firstCall, $secondCall);
    }

 }    