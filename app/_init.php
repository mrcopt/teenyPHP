<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */

$ConfigFile = ROOT . '/app/_config.php';
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