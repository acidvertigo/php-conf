<?php

namespace Acd;

/**
 * A simple trait for classes that use Singleton pattern
 */

trait Singleton
{

    protected static $instance;

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
