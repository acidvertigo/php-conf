<?php

// Check for required PHP version   
if (version_compare(PHP_VERSION, '5.6.0', '<'))
{
    exit(sprintf('This app requires PHP 5.6 or higher. Your PHP version is: %s.', PHP_VERSION));
}

// Set Error Reporting
error_reporting(E_ALL | E_STRICT);
ini_set('display_errors', true);

// Import external libraries.
if (file_exists('./vendor/autoload.php'))
{
    require './vendor/autoload.php';
}

// Core class autoload
require_once 'Autoloader.php';

// Initialize main class
$app = new Acd\Main();

// Load configuration file
$config = new Acd\Configloader('include/config.php');

// Put configuration array into the Registry
$registry = new Acd\Registry($config);

//Start database connection
$app->init('database', $registry);

$headers = $app->getHeaders();
$registry->set('headers', $headers);
print_r($registry->get('headers'));
echo $app->getUrl();