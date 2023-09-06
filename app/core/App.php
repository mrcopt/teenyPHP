<?php
/**
 * @package  teenyPHP
 * @version  0.1.0
 * @todo    
 */


/*
* App main class
*/
class App {
	
	//Setting the defaults
	private $controller = 'Entry'; //Default controller
	private $method 	= 'init'; //Default method

	//Split URL params to array values and return the array
	private function splitURL() {
		$URL = $_GET['url'] ?? 'entry';
		$URL = explode("/", trim($URL,"/"));
		return $URL;	
	}

	//Load the desired controller based on URL
	public function loadController() {
		$URL = $this->splitURL(); //Get URL params in an array

		// Select the controller
		$filename = "../app/controllers/".ucfirst($URL[0]).".php";
		if(file_exists($filename)){
			require $filename;
			$this->controller = ucfirst($URL[0]); //Select the controller 
			unset($URL[0]); //Remove controller from the URL params
		}else{
			$filename = "../app/controllers/_404.php";
			require $filename;
			$this->controller = "_404"; //If the controller asked doesn't exist, set to 404 controller
		}

		// Assign new controller to varible
		$controller = new $this->controller;

		// Select the method
		if(!empty($URL[1])) {
			if(method_exists($controller, $URL[1])) {
				$this->method = $URL[1]; //Select the method
				unset($URL[1]);//Remove method from the URL params
			}	
		}

		call_user_func_array([$controller,$this->method], $URL);
	}	
}