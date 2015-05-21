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

require_once './../../Autoloader.php';


class ConfigloaderTest extends \PHPUnit_Framework_TestCase
{

    private $path = '../../include/config.ini';
    private $wrong_path = '../../include/conffig.ini';
    
    public function testConstruct()
    {
        $class = new Acd\Configloader($this->path);
        $this->assertAttributeInternalType('array', 'data', $class);
    }
    
    /**
     * @expectedException \Exception 
     */
    public function testContstructException()
    {
        return new Acd\Configloader($this->wrong_path);  
    }
}
