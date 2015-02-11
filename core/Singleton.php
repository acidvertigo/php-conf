<?php

namespace acd;

trait Singleton {

    /** @var static Singleton instance */
    protected static $instance;

    /**
     * Get Instance
     * @return static::$instance
     */
    final public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }

    final private function __construct() { }
    
    final private function __clone() { }

    final private function __wakeup() { }

}
