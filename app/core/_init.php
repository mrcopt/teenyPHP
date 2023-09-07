<?php
/**
 * @package  teenyPHP
 * @version  0.1.0
 * @todo	 
 */


/*
* Require and initialize the files necessary to run the App
*/

//DESCRIBE
spl_autoload_register(function($classname){
	require $filename = "../app/models/".ucfirst($classname).".php";
});

//Require core app files
require '../config.php';
require '_configs.php';
require '_functions.php';
require 'Database.php';
require 'Model.php';
require 'Controller.php';
require 'App.php';