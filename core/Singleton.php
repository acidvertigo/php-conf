<?php

namespace acd;

trait Singleton {

    /** @var static Singleton instance */
    protected static $instance;

    /**
     * Get Instance
     * @return Singleton Returns self instance
     */
    final public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }

    private function __construct() {}
    
    private function __clone() { }

    private function __wakeup() { }

}
