<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd\core\tests;

if( !function_exists('apache_request_headers') ) {
///
function apache_request_headers() {
  $arh = array();
  $rx_http = '/\AHTTP_/';
  foreach($_SERVER as $key => $val) {
    if( preg_match($rx_http, $key) ) {
      $arh_key = preg_replace($rx_http, '', $key);
      $rx_matches = array();
      // do some nasty string manipulations to restore the original letter case
      // this should work in most cases
      $rx_matches = explode('_', $arh_key);
      if( count($rx_matches) > 0 and strlen($arh_key) > 2 ) {
        foreach($rx_matches as $ak_key => $ak_val) $rx_matches[$ak_key] = ucfirst($ak_val);
        $arh_key = implode('-', $rx_matches);
      }
      $arh[$arh_key] = $val;
    }
  }
  return( $arh );
}
///
}

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
  
       if (apache_request_headers() == FALSE) { 
         throw new \InvalidArgumentException('Unable to get Request Headers'); 
       } else { 
         $this->headers[] = apache_request_headers(); 
       }
       
       $request = null;
      
       foreach ($this->headers as $key => $value) {
         $request .= "$key: $value";  
       }   

     
     $this->assertEquals($this->header, $request);
   } 

}   
