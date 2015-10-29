<?php

namespace Acd;

/** 
* Response Class
* @author Acidvertigo MIT Licence 
*/

class Response 
{

    /** @var array|string $headers variable containing the headers* */
    private $headers;

    /** 
     * Check HTTP response headers
     * @param string|null $url 
     * @return array a list of response headers
     * @throws \InvalidArgumentException if response headers are null
     */
    public function getResponseHeaders($url = null)
    {
        if (get_headers($url, 1) == FALSE)
        {
            throw new \InvalidArgumentException('Unable to get Response Headers');
        } else
        {
            $this->headers = get_headers($url, 1);
        }

        return $this->headers;
    }

    /** 
     * @param string|null $url 
     * @return integer HTTP response code
     * @throws \InvalidArgumentException if the status code is outside range
     */
    public function getStatusCode($url = null)
    {
        $response = ($this->getResponseHeaders($url)[0]);
        $codeStatus = (int) substr($response, 9, 3);

        if ($codeStatus < 100 || $codeStatus > 999)
        {
            throw new \InvalidArgumentException('Invalid  status code: ' . $statusCode);
        }

        return $codeStatus;
    }

}
