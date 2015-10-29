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
        $this->assertArrayHasKey('0', $this->header);
        $this->assertContains('HTTP/1.0 200 OK', $this->header); 
        $this->assertArrayHasKey('Content-Type', $this->header);
        $this->assertContains('text/html', $this->header); 
    }
  
    public function testGetStatusCode()
    {
        $request = new \Acd\Response;
        $this->header = $request->getStatusCode('http://www.example.com');
        $this->assertEquals($this->header, 200);
    }

    /**
     * @expectedException \InvalidArgumentException 
     */
   public function testGetResponseHeadersException() {
        $request = new \Acd\Response;
        $this->header = $request->getResponseHeaders('ftp://www.example.com');
        return $this->headers;
   }

}
