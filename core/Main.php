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
   
    private $registry = null;
    private $service = null;
    private $obj = null;
	
    public function __construct()
    {
        if (!($this->registry instanceof Registry))
        {
            $this->registry = new Registry;
        }	
    }
	
    public function getService($service)
    {
        return $this->registry->get($service);
    }
  
    public function setService($class, array $args = null)
    { 
        return $this->registry->set($class, function() use ($class, $args) { $class = $this->isValidService($class); return new $class($args); });
    } 

    private function isValidService($classname)
    {
        $classname = __NAMESPACE__ . '\\' . ucwords($classname); 
        if(class_exists($classname)) 
        {
            return $classname;
        } 
        else {
            throw new \Exception("Invalid class name given: " . $classname); 
        } 
    }

    /**
     * Magic method to retrieve the Object
     * @param string $obj
     * @return object Object instance
     */
    public function __get($obj)
    {
        $obj = $this->registry->get($obj);
        return $obj();
    }

}
