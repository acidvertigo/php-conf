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
  
    private $url;
    private $header;
  
    public function setUp() {
        $this->request = 'http://www.example.com';
    }
    public function tearDown() { 
        unset($this->request);
        parent::tearDown(); 
    }
    public function testGetResponseHeaders() 
    {
        $request = new \Acd\Response;
        $this->header = $request->getResponseHeaders($this->url);
        $serverArray = ['0' => 'HTTP/1.1 200 OK', 'Content-Type' => 'text/html'];  
        foreach ($this->header as $key => $value) {
            $this->assertEquals($this->header[$key], $serverArray[$key]);
        }
    }
  
    public function testGetStatusCode()
    {
        $request = new \Acd\Response;
        $this->header = $request->getStatusCode($this->url);
        $this->assertEquals($this->header, 200);
    }  
}
