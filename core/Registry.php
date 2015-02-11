<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace acd;

require_once 'core/ArrayAccess.php';

/**
 * Registry class
 */
class Registry implements \ArrayAccess
{

    use ArrayAccess;

    /** @var array Registry configuration array */
    private $data = array();

    /** @var object|null Class instance */
    private static $instance = null;

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
     * @param string $key - registry Key
     * @param mixed $value - registry Value
     * @throws Exception When there is a duplicate $key
     */
    public function set($key, $value)
    {
        if (isset($this->data[$key])) {
            throw new \Exception("There is already an entry for key: ".$key);
        }

        $this->data[$key] = $value;
    }

    /**
     * Retrieves elements from registry array
     * @param string $key
     * @return mixed returns a registry value
     * @throws Exception when no $key found
     */
    public function get($key)
    {
        if (!isset($this->data[$key])) {
            throw new \Exception("There is no entry for key: ".$key);
        }

        return $this->data[$key];
    }
    
    public static function reset() {
        self::$instance = null;
    }

}
