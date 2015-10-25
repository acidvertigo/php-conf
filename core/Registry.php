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
 * Registry class
 *
 * Simple class to store or get elements from configuration registry
 */
class Registry implements \ArrayAccess
{

    use ArrayAccess;

    /** @var array Registry configuration array */
    private $data = [];

    /**
     * Adds element to registry array
     *
     * @param string $key - registry Key
     * @param mixed $value - registry Value
     * @throws Exception When there is a duplicate $key
     */
    public function set($key, $value)
    {
        if (isset($this->data[$key])) {
            throw new \Exception('There is already an entry for key: '.$key);
        }

        $this->data[$key] = $value;
    }

    /**
     * Retrieves elements from registry array
     *
     * @param string $key
     * @return mixed returns a registry value
     * @throws Exception when no $key found
     */
    public function get($key)
    {
        if (!isset($this->data[$key])) {
            throw new \Exception('There is no entry for key: '.$key);
        }

        return $this->data[$key];
    }

    /**
     * Reset Registry container
     */
    public function reset() {
        $this->data = [];
    }
}
