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
        if (getallheaders() == FALSE) {
          throw new \InvalidArgumentException('Unable to get Request Headers');
        } else {
          $this->headers = getallheaders();
        }
      } else {
      foreach(array_keys($_SERVER) as $skey) {
        if(substr($skey, 0, 5) == "HTTP_")
        {
            $headername = str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($skey, 5)))));
            $this->headers[$headername] = $_SERVER[$skey];
        }
       }  

      return $this->headers;
    }
  }  
}
