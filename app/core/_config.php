<?php
/**
 * @package  teenyPHP
 * @version  0.1.0
 * @todo	 Add environment specific constants for local development 
 */


/*
* App configuration file
*/

//Database configuration
define('DATABASE', array(
	'HOST'     		=> 'localhost',
	'DATABASE' 		=> 'my_database',
	'USER'     		=> 'user',
	'PASSWORD' 		=> 'password',
	'DRIVER'   		=> ''
));

//Defining paths
define('ROOT', 'http://localhost:88/teenyPHP');
define('HOME_URL', ROOT . '/public');
define('ASSETS', HOME_URL . '/assets');

//App details
define('APP', array(
	'NAME' 			=> 'teenyPHP',
	'DESCRIPTION' 	=> 'A micro sized PHP Framework',
	'VERSION' 		=> '0.1.0-alpha',
	'AUTHOR' 		=> 'mrco.pt',
	'GENERATOR' 	=> 'teenyPHP'
));

//Development and debugging
define('DEBUG', true);