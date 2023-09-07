<?php
/**
 * @package  teenyPHP
 * @version  0.1.1
 * @todo	 Add environment specific constants for local development 
 */


/*
* App details file
*/

//Defining paths
define('ROOT', 'http://localhost:80/teenyPHP');
define('HOME_URL', ROOT . '/public');
define('ASSETS', HOME_URL . '/assets');

//App details
define('APP', array(
	'NAME' 			=> 'teenyPHP',
	'DESCRIPTION' 	=> 'A micro sized PHP Framework',
	'VERSION' 		=> '0.1.1',
	'AUTHOR' 		=> 'mrco.pt',
	'GENERATOR' 	=> 'teenyPHP'
));

//Development and debugging
define('DEBUG', true);