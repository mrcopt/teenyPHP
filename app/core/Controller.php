<?php
/**
 * @package  teenyPHP
 * @version  0.1.0
 * @todo	  
 */


/*
* Trait Controller
* Base controller trait to be used by other controllers
*/

Trait Controller{

	// Function view() loads the correspondent view to the controller
	public function view($name){
		$filename = "../app/views/".$name.".view.php";
		if(file_exists($filename)) {
			require $filename;
		} else {
			$filename = "../app/views/404.view.php";
			require $filename;
		}
	}
}