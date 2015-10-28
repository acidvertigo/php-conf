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
class Configloader implements \ArrayAccess
{

    use ArrayAccess;

    /** @var array $content: Main configuration data Array */
    private $data = array();
    /** @var string $path The path of the configuration file */
    private $path = null;

    /**
     * @param string|null $path
     * @throw \Exception if configuration directory not found 
     */
    public function __construct($path)
    {
        if (file_exists($path)) {
            $this->path = $path;
        } else {
            throw new \Exception('Configuration directory not found: ' . $path);
        }
		
    }

    /**
     * Loads configuration file
     * @return array Return data configuration as array
     * @throws \Exception If php configuration file not found
     */
    public function loadconfig()
    {
        if (file_exists($this->path))
        {
            $this->data = include $this->path;
        } else
        {
            throw new \Exception('Configuration file not found: ' . $this->path);
        }

        return $this->data;
    }
}