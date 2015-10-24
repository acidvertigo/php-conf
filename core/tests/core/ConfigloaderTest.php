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
    private $wrong_path = 'include/conffig.php';
    
    public function testConstruct()
    {
        $class = new \Acd\Configloader($this->path);
        $this->assertAttributeInternalType('array', 'data', $class);
    }
    
    /**
     * @expectedException \Exception 
     */
    public function testContstructException()
    {
        return new \Acd\Configloader($this->wrong_path);  
    }
}
