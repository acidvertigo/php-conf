<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace acd;

/**
 * Registry class
 */
class Registry implements \ArrayAccess
{

    /** @var array Registry configuration array **/
    private $registry = array();

    /** @var object|null Class instance **/
    private static $instance = null;

    /** @var string $key configuration array key **/
    private static $key = null;
    
    /** @var string $value configuration array value **/
    private static $value = null;
    
    /**
     * Gets an istance of the Registry class
     * @return Registry|null
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Registry();
        }

        return self::$instance;
    }

    private function __construct() {}

    private function __clone() {}

    private function __wakeup() {}
    
    /**
     * Adds element to registry array
     * @param string $key
     * @param mixed $value
     * @throws Exception When there is a duplicate $key
     */
    public function set($key, $value)
    {
        if (isset($this->registry[$key])) {
            throw new \Exception("There is already an entry for key: ".$key);
        }

        $this->registry[$key] = $value;
    }

    /**
     * Retrieves elements from registry array
     * @param string $key
     * @return string
     * @throws Exception when no $key found
     */
    public function get($key)
    {
        if (!isset($this->registry[$key])) {
            throw new \Exception("There is no entry for key: ".$key);
        }

        return $this->registry[$key];
    }
    
    public static function reset() {
        self::$instance = null;
    }

    public function offsetExists($key)
    {
        return isset($this->registry[$key]);
    }

    public function offsetGet($key)
    {
        if (isset($this->registry[$key])) {
            return $this->registry[$key];
        }

        return null;
    }

    public function offsetSet($key, $value)
    {
        if (is_null($key)) {
            $this->registry[] = $value;
        } else {
            $this->registry[$key] = $value;
        }
    }

    public function offsetUnset($key)
    {
        unset($this->registry[$key]);
    }

}
