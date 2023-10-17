<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */

/**
 * Site settings
 */

//Application details
define('APP', array(
	'FRAMEWORK' => array(
		'NAME' 				=> 'teenyPHP',
		'DESCRIPTION'	=> 'A micro sized PHP Framework',
		'VERSION' 		=> '0.0.1',
		'AUTHOR' 			=> 'mrco.pt',
		'MIN_PHP'	 		=> '8.1'
	),
	'SITE' => array(
		'NAME' 				=> 'SAEM',
		'DESCRIPTION' => 'School Assets and Equipment Management',
		'VERSION' 		=> '0.0.1',
		'AUTHOR' 			=> 'mrco.pt',
		'ENV'					=> 'DEV', //LIVE, DEV, MAINT
		'SERVICES'		=> array(
			'RECAPTCHA' 	=> array(
				'PUBLIC' 		=> 'YOUR_PUBLIC_G_RECAPTCHA',
				'PRIVATE'		=> 'YOUR_PRIVATE_G_RECAPTCHA'
			)
		)
	),
	'DATABASE' => array(
		'HOST'     		=> 'localhost',
		'DATABASE' 		=> 'database',
		'USER'     		=> 'user',
		'PASSWORD' 		=> 'password',
		'DRIVER'   		=> '',
		'CHARSET'			=> 'utf8mb4'
	)
));


//Constants
if (APP['SITE']['ENV'] === 'DEV'){
	define('DEBUG', true);
} else {
	define('DEBUG', false);
}
define('DEFAULT_LANG', 'en');
define('MINIFY_DATA', true);