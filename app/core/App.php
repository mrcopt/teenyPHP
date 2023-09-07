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
	private function parseURL() {
		//Add full URI to array
		$URL['Request'] = trim($_SERVER['REQUEST_URI'],"/");

		//Get and Split the URI (array_filter unsets empty values)
		$URI = array_filter(explode("/", trim($_SERVER['REQUEST_URI'],"/")),'strlen');

		//Remove structure from URI
		unset($URI[0]); //remove base
		unset($URI[1]); //remove public

		//Set controller in array if exists
		if (array_key_exists(2,$URI)){
			$URL['Controller'] = $URI[2];
			unset($URI[2]); //remove Controller from URI
		} else {
			//Manually set entry controller if nothing found
			if (!array_key_exists(2,$URI))
			$URL['Controller'] = 'entry';
		}

		//Set method in array if exists
		if (array_key_exists(3,$URI)){
			$URL['Method'] = $URI[3];
			unset($URI[3]); //remove Method from URI
		}

		//Set parameters if there are any
		if (count($URI)){
			for ($i=0; $i < count($URI); $i++) { 
				$URL['Param'.$i+1] = $URI[$i+4];
			}
		}

		//Return URL
		return $URL;
	}

	//Load the desired controller based on URL
	public function loadController() {
		$URL = $this->parseURL(); //Get URL params in an array
		
		// Select the controller
		$filename = "../app/controllers/".ucfirst($URL['Controller']).".php";
		if(file_exists($filename)){
			require $filename;
			$this->controller = ucfirst($URL['Controller']); //Select the controller 
		}else{
			$filename = "../app/controllers/_404.php";
			require $filename;
			$this->controller = "_404"; //If the controller asked doesn't exist, set to 404 controller
		}

		// Assign new controller to varible
		$controller = new $this->controller;

		// Select the method
		if(!empty($URL['Method'])) {
			if(method_exists($controller, $URL['Method'])) {
				$this->method = $URL['Method']; //Select the method
			}	
		}

		//Call function
		call_user_func_array(
			array($controller,$this->method),
			array($URL['Controller'],!empty($URL['Method']))
		);
	}	
}