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
  
       
        $this->header = $this->request_headers();
            
     $this->assertEquals($this->header, ['Accept-Language' => 'it']);
   }

     public function request_headers()
     {
    if(function_exists("apache_request_headers"))
    {
        if($headers = apache_request_headers()) 
        {
            return $headers;
        }
    }

    $headers = array();
    foreach(array_keys($_SERVER) as $skey)
    {
        if(substr($skey, 0, 5) == "HTTP_")
        {
            $headername = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($skey, 5)))));
            $header[$headername] = $_SERVER[$skey];
        }
    }
    return $headers;
} 

}   
