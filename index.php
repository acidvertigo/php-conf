<?php
// Import core libraries.
require './vendor/autoload.php';
require_once 'Autoloader.php';

    $registry = new Acd\Registry;

    $config = new Acd\Configloader('include/config.php');

    // Loads configuration into the registry
	foreach($config->loadconfig() as $key => $value) {
        $registry->set($key, $value);
	}

    $database = new Acd\Database($registry->get('database'));

    // Connect to database
    $database = $database->connect();


foreach ($registry->get('database') as $key => $value) {
	echo 'Key = ' . $key . ' Value = ' . $value . '<br>';
}

// Close connection to the database
$database->disconnect();
