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

    private $path = 'include/config.ini';


    public function testConstruct()
    {
        $class = new \acd\Configloader($this->path);
        $this->assertAttributeInternalType('array', 'data', $class);
    }
    
    public function testFileLoad()
    {
        $this->assertFileExists($this->path);   
    }
}
