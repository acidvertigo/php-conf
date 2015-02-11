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
        if(!self::$instance) { // If no instance then make one
            self::$instance = new self();
	}
	
        return self::$instance;
    }

    private function __construct() { }
    
    private function __clone() { }

    private function __wakeup() { }

}
