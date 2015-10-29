<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Acd\core\tests;
/**
 * Description of ResponseTest
 *
 * @author Luca
 */
class ResponseTest extends \PHPUnit_Framework_TestCase
{

    private $header;

    public function testGetResponseHeaders() 
    {
        $request = new \Acd\Response;
        $this->header = $request->getResponseHeaders('http://www.example.com');
        $serverArray = ['0' => 'HTTP/1.0 200 OK', 'Content-Type' => 'text/html'];  
        foreach ($this->header as $key => $value) {
            $this->assertEquals($this->header[$key], $serverArray[$key]);
        }
    }
  
    public function testGetStatusCode()
    {
        $request = new \Acd\Response;
        $this->header = $request->getStatusCode('http://www.example.com');
        $this->assertEquals($this->header, 200);
    }  
}
