<?php 

namespace Acd;

/** 
* Response Class
* @author Acidvertigo MIT Licence 
*/

class Response 
{

    private $headers = [];

    /** 
     * Check HTTP response headers
     * @param string|null $url 
     * @return array list of response headers 
     */
    public function getResponseHeaders($url = null)
    {
        if (get_headers($url, 1) == FALSE)
        {
            throw new \InvalidArgumentException('Unable to get Response Headers');
        } else
        {
            $this->headers[] = get_headers($url, 1);
        }

        return $this->headers;
    }

    /** 
     * @param string|null $url 
     * @return integer HTTP response code 
     */
    public function getStatusCode($url = null)
    {
        $codeStatus = (int) substr($this->getResponseHeaders($url)[0], 9, 3);

        if ($codeStatus < 100 || $codeStatus > 999)
        {
            throw new \InvalidArgumentException('Invalid  status code: ' . $statusCode);
        }

        return $codeStatus;
    }

}