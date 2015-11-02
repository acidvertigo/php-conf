<?php

/**
 * The MIT License
 *
 * Copyright 2015 Acidvertigo.
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 */

namespace Acd;

/**
 *  Main app class
*
 * @author Acidvertigo
 */
class Main {
   
    private $http;
	private $registry;
    private $request;
    private $response;
    private $uri;

    public function __construct (Registry $registry)
    {
        $this->http = new Http;
        $this->request = new Request;
        $this->response = new Response;
		$this->registry = $registry;
        $this->uri = new Uri($this->http);
    }
	
	public function connect()
	{
		return $this->registry->get('db');
	}

    /**
     * Return request headers
     * @return array
     */
    public function getHeaders() 
    {
        return $this->request->getRequestHeaders();
    }

    /**
     * Returns current url
     * @return string
     */
    public function getUrl()
    {
        return $this->uri->getUrl();
    }
}