<?php
// Import core libraries.
require_once('core/Registry.php');
require('core/Configloader.php');
require_once('core/Database.php');

try {

    // Get an instance of the Registry
    $registry = \acd\Registry::getInstance();

    // Load configuration into the registry
    $registry->set('config', new \acd\Configloader('include/config.ini'));

    // Connect to database
    if (\acd\Registry::getInstance() !== null) {
        \acd\Database::connect(\acd\Registry::getInstance());
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}

\acd\Database::disconnect();
