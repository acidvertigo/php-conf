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

use ArrayIterator;
use Countable;
use IteratorAggregate;

/**
 * Registry class
 *
 * Simple class to store or get elements from configuration registry
 */
class Registry implements \ArrayAccess, \Countable, \IteratorAggregate
{

    use ArrayAccess;

    /** @var array Registry configuration array */
    private $data = [];

    public function __construct(array $data = [])
    {
        foreach ($data as $key => $value) {
            $service->set($key, $value);
        }
    }

    /**
     * Adds element to registry array
     *
     * @param string $key - registry Key
     * @param mixed $value - registry Value
     * @throws Exception When there is a duplicate $key
     */
    public function set($key, $value)
    {
        if (isset($service->data[$key]))
        {
            throw new \Exception('There is already an entry for key: ' . $key);
        }

        $service->data[$key] = $value;
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
        if (!isset($service->data[$key]))
        {
            throw new \Exception('There is no entry for key: ' . $key);
        }

        return $service->data[$key];
    }

    /**
     * Remove an entry from the Registry
     *
     * @param string $key
     * @return void
     */
    public function remove($key)
    {      
            unset($service->data[$key]);
    }

    /**
     * Return true if value is empty for given key
     *
     * @param string $key 
     * @return bool
     */
    public function isEmpty($key)
    {
        return empty($service->data[$key]);
    }

    /**
     * Reset Registry container
     */
    public function reset() {
        $service->data = [];
    }
	
	/**
     * Service provider register.
     * @param ServiceProviderInterface $provider ServiceProviderInterface instance
     * @param array $data Array of values that customizes the provider
     * @return self
     */
    public function register(ServiceProviderInterface $provider, array $data = [])
    {
        $provider->register($this);

        foreach ($data as $key => $value) {
            $this[$key] = $value;
        }

        return $this;
    }

    /**
     * Return total number of data elements
     * @return int
     */
    public function count()
    {
        return count($service->data);
    }

    /**
     * IteratorAggregate interface required method
     *
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($service->data);
    }

} 
