<?php 
  
namespace Acd; 
  
/** 
* Http class
* @author Acidvertigo MIT Licence 
*/ 
class Http 
{ 
  
    /** 
     * Check HTTP version
     * @return string 
     */
    public function protocol()
    {  
    return $_SERVER['SERVER_PROTOCOL'];
    }
  
    /** 
     * Check if communication is on SSL or not
     * @return bool true on HTTPS 
     */
    public function isSsl()
    {  
    return (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? true : false;
    }
  
    /** 
     * @param string $method HTTP method
     * @return bool true if the mothod is safe
     */ 
    public function isSafeMethod($method) 
    { 
        $safeMethods = ['HEAD', 'GET', 'OPTIONS', 'TRACE'];
        return isset($safeMethods[$method]);
    } 

  
    /** 
     * @param string $method HTTP method
     * @return bool true if the method is idempotent
     */ 
    public function isIdempotentMethod($method) 
    { 
        // Though it is possible to be idempotent, POST 
        // is not guarunteed to be, and more often than 
        // not, it is not. 
        $idempotentMethods = ['DELETE', 'GET', 'HEAD', 'OPTIONS', 'PATCH', 'PUT', 'TRACE'];
        return isset($idempotentMethods[$method]);
    }
}
