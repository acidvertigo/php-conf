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
     * Check HTTP response headers
     * @param string $url 
     * @return array list of response headers 
     */
    public function getRequestHeaders()
    {  

      if (getallheaders() == FALSE) {
        throw new \InvalidArgumentException('Unable to get Request Headers');
      } else {
        $this->headers[] = getallheaders();
      }  

      return $this->headers;
    }

}
