<?php
// Import core libraries.
require 'core/Configloader.php';
require 'core/Database.php';
require_once 'core/Registry.php';

try {

    // Get an instance of the Registry
    $registry = \acd\Registry::getInstance();

    // Load configuration into the registry
    $registry->set('config', new \acd\Configloader('include/config.ini'));

    // Connect to database
    \acd\Database::connect($registry);

} catch (\Exception $e) {
    echo $e->getMessage();
}

\acd\Database::disconnect();
