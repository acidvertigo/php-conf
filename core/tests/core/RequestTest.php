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
            
     $this->assertEquals($this->header, ['HTTP_ACCEPT_LANGUAGE' => 'it']);
   }

     public function request_headers()
     {
    if(function_exists("apache_request_headers")) // If apache_request_headers() exists...
    {
        if($headers = apache_request_headers()) // And works...
        {
            return $headers; // Use it
        }
    }

    $headers = array();
    foreach(array_keys($_SERVER) as $skey)
    {
        if(substr($skey, 0, 5) == "HTTP_")
        {
            // $headername = str_replace("_", " ", substr($skey, 0, 5)))));
            $headers[$skey] = $_SERVER[$skey];
        }
    }
    return $headers;
} 

}   
