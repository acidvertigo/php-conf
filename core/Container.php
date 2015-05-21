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
 * Dependency injection container class
 *
 * @author acidvertigo
 */
class Container implements \ArrayAccess
{

    use ArrayAccess;
        
    /**
     * Container Array
     * @var array
     */
    protected $values = array();

    /**
     * Adds an item to the container
     * @param string $key
     * @param mixed $value
     * @return mixed $value   
     * @throws Exception When there is a duplicate $key
     */
    public function add($key, $value)
    {
        if ($this->exists($key)) {
            throw new \InvalidArgumentException("[{$key}] already exists");
        }
        return $this->values[$key] = $value;
    }

    /**
     * Returns item from container
     * @param string $name
     * @return mixed
     */
    public function make($name)
    {
        if (!$this->exists($name)) {
            throw new \InvalidArgumentException("[{$name}] not found");
        }
        return $this->find($name);
    }

    /**
     * Finds a Value
     * @param  mixed $key
     * @return mixed
     */
    private function find($key)
    {
        if (is_object($key)) {
            return $this->values[$key]();
        }
        return $this->values[$key];
    }

    /**
     * Checks if a key exists in container
     * @param  string $key
     * @return bool
     */
    private function exists($key)
    {
        return array_key_exists($key, $this->values);
    }
}
