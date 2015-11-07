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

// Initialize container class
$app = new \Acd\Container;

// Initialize Services
$request = $app->resolve('\Acd\Request'); //Request
$file = $app->resolve('\Acd\FileSystem', ['include/config.php']); //FileSystem
$config = $app->resolve('\Acd\Config', [$file]); //Config
$database = $app->resolve('\Acd\Database', [$config]); //Database

//Start database connection
$database->connect();
