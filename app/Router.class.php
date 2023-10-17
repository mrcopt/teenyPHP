<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */
namespace App;

class Router {
	
	private $Path = [
		'Type' => 'Html', // Holds the route type, defaults to Html
	];

	/**
	 * Router logic
	 */
	public function __construct()
	{
		$URI = \App\Helper::getUrlArray(); //Get the URI in an array
		
		$this->getType($URI[0]); //Get the request Type

		// Call the right method
		if ($this->Path['Type'] == 'Api') {
			new \App\Router\Api($URI);
		} elseif ($this->Path['Type'] == 'Html') {
			Helper::show($this->Path);
			new \App\Router\Html($URI);
		}
	}

	/**
	 * Get type of request
	 */
	private function getType(string $URI) : void
	{
		if(!empty($URI) and $URI == 'api') {
			$this->Path['Type'] = 'Api';
		} else {
			$this->Path['Type'] = 'Html';
			Helper::show($this->Path);
		}
	}
}