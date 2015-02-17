<?php
// Import core libraries.
require_once 'core/Configloader.php';
require_once 'core/Database.php';
require_once 'core/Registry.php';
require_once 'core/Container.php';

$container = new \acd\Container;

$container->add('registry', function()
{
    return \acd\Registry::getInstance();
});
$container->make('registry');
var_dump($container);
try {

    // Get an instance of the Registry
    $registry = \acd\Registry::getInstance();

    // Load configuration into the registry
    $registry->set('config', new \acd\Configloader('include/config.ini'));

    // Connect to database
    $database = acd\Database::connect($registry->get('config')['database']);

} catch (\Exception $e) {
    echo $e->getMessage();
}

\acd\Database::disconnect();
