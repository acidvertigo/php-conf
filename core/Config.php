<?php

/*
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
 * Configloader - Configuration file loader class
 * @author Acidvertigo
 */
class Config
{

    /** @var array $content Main configuration data Array */
    private $data = [];
	
    /** @var \Acd\FileSystem $file Configuration file **/
    private $file;
	
    public function __construct(FileSystem $file)
    {
        $this->file = $file;
    }

    /**
     * Loads configuration file
     * @return array Return data configuration as array
     * @throws \Exception If php configuration file not found
     */
    public function loadconfig()
    {
        if ($this->file)
        {
            $this->data = $this->file->load();
        }

        return $this->data;
    }

    /**
     * Configuration get method
     * @param string $key The Configuration key to find
     * @return array The configuration array values
     * @throws \Exception if configuration key is not set
     */ 

    public function get($key)
    {
        if (empty($this->data))
        {
            $this->loadconfig();
        }


        if (!isset($this->data[$key]))
        {
            throw new \Exception ('Configuration key: ' . $key . 'not found');
        }

        return $this->data[$key];    
    }
    
}
