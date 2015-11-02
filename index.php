<?php

// Check for required PHP version   
if (version_compare(PHP_VERSION, '5.6.0', '<'))
{
    exit(sprintf('This app requires PHP 5.6 or higher. Your PHP version is: %s.', PHP_VERSION));
}

error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

// Import external libraries.
if (file_exists('./vendor/autoload.php'))
{
    require './vendor/autoload.php';
}

// Core class autoload
require_once 'Autoloader.php';

//Initialize Registry object
$registry = new Acd\Registry;
$registry->set('db', function() { return new \Acd\Database($registry); });

$app = new Acd\Main($registry);
$config = new Acd\Configloader('include/config.php');


// Loads configuration into the registry
foreach ($config->loadconfig() as $key => $value) {
    $registry->set($key, $value);
}

// Connect to database
$database = $app->connect();

foreach ($registry->get('database') as $key => $value) {
    echo 'Key = ' . $key . ' Value = ' . $value . '<br>';
}

$headers = $app->getHeaders();
$registry->set('headers', $headers);
print_r($registry->get('headers'));
echo $app->getUrl();