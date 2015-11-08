<?php

namespace Acd;

/** 
 * Request Class
 * @author Acidvertigo MIT Licence
 */

class Request
{
    /** @var array $headers the request headers * */
    private $headers = [];
    /** @var array $body the request body * */
    private $body;

    private $http;

    public function __construct(Http $http)
    {
        $this->http = $http;
    }

	 /**
     * Check HTTP request headers
     * @return array list of response headers
     * @throws \InvalidArgumentException if header is null
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
    public function getBody()
    {
        $this->body = @file_get_contents('php://input');
        return $this->body;
    }

    /** 
     * Helper function if getallheaders() not available
     * @return array list of response headers 
     */
    private function getServerHeaders()
    {

            foreach ($_SERVER as $key => $value) {
            if (substr($key, 0, 5) == 'HTTP_')
            {
                $this->headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($key, 5)))))] = $value;
            } elseif ($key == 'CONTENT_TYPE')
            {
                $this->headers['Content-Type'] = $value;
            } elseif ($key == 'CONTENT_LENGTH')
            {
                $this->headers['Content-Length'] = $value;
            }
        }

        return $this->headers;
    }
}
