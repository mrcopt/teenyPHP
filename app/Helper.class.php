<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */

 namespace App;

 class Helper{
	
	//Print code block <pre> of raw data passed
	public static function show($data,$what = null) {
		if (isset($what)){
			print('<h3>'.$what.':</h3>');
			print('<pre>');
			print_r($data);
			print('</pre><br>');
		} else {
			print('<pre>');
			print_r($data);
			print('</pre><br>');
		}
	}

	// Removing slash from strings
	public static function removeSlashes(string $url): string {
		return trim($url, '/');
	}

	// Return current URL in an array
	public static function getUrlArray() : array {
		return $URL = explode('/', self::removeSlashes($_SERVER['REQUEST_URI']) ) ;
	}

	// Return string formatted in first letter uppercase
	public static function format_ucfirst(string $String) : string {
		return $String = ucfirst(strtolower($String));
	}
 }