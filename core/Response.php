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
     * Function to obtain the HTTP response headers
     * @param string|null $url 
     * @return array a list of response headers
     * @throws \InvalidArgumentException if response headers are null
     */
    public function getResponseHeaders($url = null)
    {
        $response = @get_headers($url, 1);
        if (!is_array($response) || $response  === FALSE)
        {
            throw new \InvalidArgumentException('Unable to get Response Headers');
        }
            $this->headers = $response;

        return $this->headers;
    }

    /**
     * Gets HTTP status code 
     * @param string|null $url 
     * @return integer HTTP response code
     * @throws \InvalidArgumentException if the status code is outside range
     */
    public function getStatusCode($url = null)
    {
        $response = ($this->getResponseHeaders($url)[0]);
        $codestatus = (int) substr($response, 9, 3);

        if ($codestatus < 100 || $codestatus > 999)
        {
            throw new \InvalidArgumentException('Invalid response status code: ' . $codestatus);
        }

        return $codestatus;
    }

}
