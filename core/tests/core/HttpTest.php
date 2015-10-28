<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Acd\core\tests;

/**
 * Http Class Test
 * @author Acidvertigo
 */

class HttpTest extends \PHPUnit_Framework_TestCase
{
    public function setUp() {
        $_SERVER['SERVER_PROTOCOL'] = 'HTTP/1.1';
        $_SERVER['HTTPS'] = 'ON';
        $_SERVER['PORT'] = '80';
    }

    public function tearDown() {
        unset($_SERVER['SERVER_PROTOCOL']);
        unset($_SERVER['HTTPS']);
        unset($_SERVER['PORT']);
        parent::tearDown();
    }

    public function testProtocol()
    {
        $http = new \Acd\Http;

        $this->assertInternalType('string', $http->protocol());
        $this->assertContains('HTTP/1.1', $http->protocol());                           
    }


    public function testIsSsl()
    {
        $http = new \Acd\Http;

        $this->assertTrue($http->isSsl());
    }

    public function testIsSafeMethod()
    {
        $http = new \Acd\Http;
        $safeMethods = ['HEAD', 'GET', 'OPTIONS', 'TRACE'];

        foreach ($safeMethods as $value) {
            $this->assertTrue($http->isSafeMethod($value));
        }

    }

    public function testIsIdempotentMethod() 
    { 
        $http = new \Acd\Http;
        $idempotentMethods = ['DELETE', 'GET', 'HEAD', 'OPTIONS', 'PATCH', 'PUT', 'TRACE'];

        foreach ($idempotentMethods as $value) {
            $this->assertTrue($http->isIdempotentMethod($value));
        }
    }

}