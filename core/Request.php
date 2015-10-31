<?php 

namespace Acd;

/** 
* Request Class
* @author Acidvertigo MIT Licence
*/

class Request 
{

    private $headers = [];

    private $body;

    /**
     * Check HTTP request headers
     * @return array list of response headers
     * @throws InvalidArgumentException if header is null
     */
    public function getRequestHeaders()
    {
        if (function_exists('getallheaders()'))
        {
            $this->headers = getallheaders();
        } else
        {
            $this->headers = $this->getServerHeaders();
        }
        if ($this->headers !== null)
        {
            return $this->headers;
        } else
        {
            throw new \InvalidArgumentException('Unable to get Request Headers');
        }
    }
    
    /**
     * @return string the actual request method
     */
    public function getReqestMethod()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }
    
    /**
     * Get request body
     * @return string the request body
     */
    public function getBody ()
    { 
        if ($this->body == null) 
        {
            $this->body = @file_get_contents('php://input');
        }
        
      return $this->body;
    }
 

    /** 
     * Helper function if getallheaders() not available
     * @return array list of response headers 
     */
    private function getServerHeaders()
    {
        foreach (array_keys($_SERVER) as $skey) {
            if (strpos($skey, 'HTTP_') !== FALSE)
            {
                $this->headers[str_replace(' ', '-', ucwords(str_replace('_', ' ', strtolower(substr($skey, 5)))))] = $_SERVER[$skey];
            }
        }

        return $this->headers;
    }
}
