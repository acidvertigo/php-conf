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
         $this->header = "GET / HTTP/1.1 \r\n" .
            "Accept: image/gif, image/x-xbitmap, image/jpeg, image/pjpeg, application/x-shockwave-flash, application/msword, application/vnd.ms-excel, */* \r\n" .
            "Accept-Language: it \r\n" .
            "Accept-Encoding: gzip, deflate \r\n" .
            "User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1) \r\n" .
            "Host: localhost \r\n" .
            "Connection: Keep-Alive" .
            "Cookie: __utma=151439968.604684092.1165355506.1165355506.1165357918.2; __utmz=151439968.1165357918.2.2.utmccn=(organic)|utmcsr=google|utmctr=%2Beclipse+%2B%22web+editor%22|utmcmd=organic \r\n"; 
  } 
 	 
  public function tearDown() { 
    unset($this->header);
    parent::tearDown(); 
  } 
  
     public function testGetRequestHeaders() 
     {   
  
       if (getallheaders() == FALSE) { 
         throw new \InvalidArgumentException('Unable to get Request Headers'); 
       } else { 
         $this->headers[] = getallheaders(); 
       }
       
       $request = null;
      
       foreach ($this->headers as $key => $value) {
         $request .= "$key: $value";  
       }   

     
     $this->assertEquals($this->header, $request);
   } 

}   
