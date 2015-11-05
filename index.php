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

// Start configuration loader
$app->setService('configloader');
$config = $app->configloader->loadconfig('include/config.php');

// Start Database connection
$app->setService('database', $config);
$app->database->connect();

// Start Request Service
$app->setService('request');
print_r($app->request->getRequestHeaders());
