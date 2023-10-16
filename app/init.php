<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */

/**
 * Autoloading file:
 * ##############################################
 * ########### Do not touch this file ###########
 * ##############################################
 * Firstly load the class Autoloader with name App
 * Adds the configuration file to the start of all
 * Verify if you are in debugging version or not
 * Set the application language automatically
 * Load vendor, classes and functions in the following order
 * Deny access to the folder app and vendor if using php webserver
 * And finally it adds and load all the routes then initialize all
 */

$ConfigFile = ROOT . '/app/config.php';
$AutoLoader = ROOT . '/app/Autoload.class.php';

if (file_exists($ConfigFile)) { 
	require_once $ConfigFile;
} else {
	die('Configuration file not found.');
}

// Run checks
if (PHP_VERSION < APP['FRAMEWORK']['MIN_PHP']){ die('PHP version is '.PHP_VERSION.'. This application requires at least version '.APP['FRAMEWORK']['MIN_PHP']);}
if (DEBUG) {
	error_reporting(E_ALL);
	ini_set('display_errors', 'on');

	require_once '_functions.php';
}

// Import App logic code
if (file_exists($AutoLoader)) { 
	require_once $AutoLoader;
	new App\Autoload;
} else {
	die('Configuration file not found.');
}

/*
\App::setLanguage();
foreach(\App::loadVendor() as $dir) { require_once($dir); }
foreach(\App::loadClasses() as $dir) { require_once($dir); }
foreach(\App::loadFunctions() as $dir) { require_once($dir); }

\App::isForbidden(
	['app', 'vendor']
);
*/

$App = new \App\Core;