<?php 
  
namespace Acd; 
  
/** 
* Request Class
* @author Acidvertigo MIT Licence 
*/

class Request 
{

    private $headers = [];

    /** 
     * Check HTTP request headers
     * @return array list of response headers 
     */
    public function getRequestHeaders()
    {
      if(function_exists("getallheaders()")) {
        if (getallheaders() == null) {
          throw new \InvalidArgumentException('Unable to get Request Headers');
        } else {
          $this->headers = getallheaders();
        }
      } else {
       $this->headers = $this->getServerHeaders();
      }
    return $this->headers;  
  } 
  
  private function getServerHeaders() {
    foreach(array_keys($_SERVER) as $skey)
    {
      if(strpos($skey, 'HTTP_') !== FALSE)
      {
        $this->headers[str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($skey, 5)))))] = $_SERVER[$skey];
      }
    }  

    return $this->headers;
  }
}
