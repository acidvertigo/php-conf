<?php
// Import core libraries.
require '../../vendor/autoload.php';
require_once 'Autoloader.php';

$container = new Acd\Container;

$container->add('registry', function()
{
    return Acd\Registry::getInstance();
});

try {

    // Get an instance of the Registry
    $registry = $container->make('registry');

    // Loads configuration into the registry
    $registry->set('config', new Acd\Configloader('include/config.ini'));

    // Connect to database
    $database = $database::connect($registry->get('config')['database']);

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
