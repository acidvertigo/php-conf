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
  
  public function setUp() {
         $_SERVER['HTTP_ACCEPT_LANGUAGE'] = 'it';
  }

  public function tearDown() { 
    unset($_SERVER['HTTP_ACCEPT_LANGUAGE']);
    parent::tearDown(); 
  }
  
     public function testGetRequestHeaders() 
     {
        $request = new \Acd\Request;
        $this->header = $request->getRequestHeaders();
        $this->assertEquals($this->header, ['Accept-Language' => 'it']);
     }

}