<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd\core\tests;


/**
 * Description of RequestTest
 *
 * @author Luca
 */
class RequestTest extends \PHPUnit_Framework_TestCase
{
  
    private $header;
	private $http;
  
    public function setUp() {
        $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'it';
        $_SERVER['HTTP_ACCEPT_ENCODING'] = 'gzip, deflate, sdch';
        $_SERVER['REQUEST_METHOD'] = 'GET';
		$_SERVER['HTTP_HOST'] = 'localhost';
		$this->http = (new \Acd\Container)->resolve('\Acd\Http');
    }

    public function tearDown() { 
        unset($_SERVER['HTTP_ACCEPT_LANGUAGE']);
        unset($_SERVER['HTTP_ACCEPT_ENCODING']);
        unset($_SERVER['REQUEST_METHOD']);

        parent::tearDown(); 
    }

    public function testGetRequestHeaders() 
    {
        $request = new \Acd\Request($this->http);
        $this->header = $request->getRequestHeaders();

        $serverArray = ['Accept-Language' => 'it', 'Accept-Encoding' => 'gzip, deflate, sdch'];  

        foreach ($this->header as $key => $value) {
            $this->assertEquals($this->header[$key], $serverArray[$key]);
        }

    }
    
    public function testGetReqestMethod()
        {
            $request = new \Acd\Request($this->http);
            $method = $request->getReqestMethod();
            $this->assertSame('GET', $method);
        }   
}
