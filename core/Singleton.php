<?php

namespace acd;

trait Singleton {

    /** @var object Singleton instance */
    protected static $instance;

    /**
     * @return Singleton
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
