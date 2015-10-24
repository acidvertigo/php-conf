<?php
// Import core libraries.
require '../../vendor/autoload.php';
require_once 'Autoloader.php';

$registry = new Acd\Registry;

try {

    // Loads configuration into the registry
    $registry->set('config', new Acd\Configloader('include/config.php'));
    $database = new Acd\Database($registry->get('config')['database']);

    // Connect to database
    $database = $database->connect();

} catch (\Exception $e) {
    echo $e->getMessage();
}

// Gets configuration group from the registry
$data = $registry->get('config');

foreach ($data['database'] as $key => $value) {
	echo 'Key = ' . $key . ' Value = ' . $value . '<br>';
} 

foreach ($data['test'] as $key => $value) {
	echo 'Key = ' . $key . ' Value = ' . $value . '<br>';
} 

// Close connection to the database
Acd\Database::disconnect();
