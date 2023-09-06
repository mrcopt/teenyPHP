<?php
/**
 * @package  teenyPHP
 * @version  0.1.0
 * @todo	 
 */


/*
* Collection of usefull functions to use in the whole App
*/

//Print code block <pre> of raw data passed
function show($data) {
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

//Escape the passed string
function esc($string) {
	return htmlspecialchars($string);
}

//Redict to path given
function redirect($path) {
	header("Location: " . HOME_URL . "/" .$path);
	die;
}

//Include a partial view output
function partial($name){
	if (file_exists('../app/views/partials/'.$name.'.partial.php')) {
		require '../app/views/partials/'.$name.'.partial.php';
	} else {
		print('Partial view not founded.');
	}
}