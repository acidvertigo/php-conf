<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd\core\tests;

/**
 * Description of RegistryTest
 *
 * @author Luca
 */

class HttpTest extends \PHPUnit_Framework_TestCase
{
    public function setUp(){
      $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
      $_SERVER['HTTPS'] = 'ON';
      $_SERVER['PORT'] = '80';
    }
    
    /** 
     * Check HTTP version
     * @return string 
     */
    public function testProtocol()
    {  
         $this->assertInternalType('string', filter_input(INPUT_SERVER, 'SERVER_PROTOCOL'));
         $this->assertContains('HTTP/1.1', filter_input(INPUT_SERVER, 'SERVER_PROTOCOL'));                           
    }
  
    /** 
     * Check if communication is on SSL or not
     * @return bool true on HTTPS 
     */
    public function testIsSsl()
    {  
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );

    }
  
    /** 
     * @param string $method HTTP method
     * @return bool true if the mothod is safe
     */ 
    public function testIsSafeMethod($method) 
    { 
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    } 

  
    /** 
     * @param string $method HTTP method
     * @return bool true if the method is idempotent
     */ 
    public function isIdempotentMethod($method) 
    { 
        $this->markTestIncomplete(
            'This test has not been implemented yet.'
        );
    }

}

