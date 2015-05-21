<?php
// Import core libraries.
require '../../vendor/autoload.php';
require_once 'Autoloader.php';

$container = new Acd\Container;

$container->add('registry', function()
{
    return Acd\Registry::getInstance();
});

$container->make('registry');

try {

    // Get an instance of the Registry
    $registry = Acd\Registry::getInstance();

    // Load configuration into the registry
    $registry->set('config', new Acd\Configloader('include/config.ini'));

    // Connect to database
    $database = Acd\Database::connect($registry->get('config')['database']);

} catch (\Exception $e) {
    echo $e->getMessage();
}
var_dump($registry);
Acd\Database::disconnect();
