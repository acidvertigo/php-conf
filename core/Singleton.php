<?php

namespace acd;

trait Singleton {

    /** @var static Singleton instance */
    protected static $instance;

    /**
     * Get Instance
     * @return void Returns self instance
     */
    final public static function getInstance()
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static;
    }

    protected function __construct() { }
    
    protected function __clone() { }

    protected function __wakeup() { }

}
