<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */
namespace App;

use App\Header;
use App\Mimetype;
use App\Autoload;

class Router {
	
	private $Path = [
		'Type' => 'Html', // Holds the route type, defaults to Html
		'Controller' => 'Start', // Holds the controller, defaults to controller Index
		'Method' => 'Default', // Holds the method, defaults to method Init
		'Args' => '' // Holds the arguments, if there are any, defaults to empty
	];

	/**
	 * Router logic
	 */
	public function __construct()
	{
		$URI = Core::getUrlArray(); //Get the URI in an array
		
		$this->getType($URI[0]); //Get the request Type

		// Call the right method
		if ($this->Path['Type'] == 'Api') {
			$this->routeApi($URI);
		} elseif ($this->Path['Type'] == 'Html') {
			$this->routeHtml($URI);
		}
	}

	/**
	 * Get type of request
	 */
	public function getType(string $URI) : void
	{
		if(!empty($URI) and $URI == 'api') {
			$this->Path['Type'] = 'Api';
		} else {
			$this->Path['Type'] = 'Html';
		}
	}

	/**
	 * Route HTML Requests
	 */
	public function routeHtml(array $Uri)
	{
		//if URI not empty
		if (!empty($Uri[0])) {
			//check if controller exists
			if ($this->existsController($Uri[0])) {
				//set this controller
				$this->Path['Controller'] = Core::format_ucfirst($Uri[0]);
				//load this controller
				Autoload::Controller($this->Path['Controller']);
				//check and set method
				if(!empty($Uri[1])) {
					$this->getMethod($Uri[1]);
				}
				//set args
				$this->getArgs($Uri);
				//Run the controller, method and pass args
				new $this->Path['Controller']($this->Path['Method'], $this->Path['Args']);

			} else {
				$this->Path['Controller'] = 'Error';
				Autoload::Controller($this->Path['Controller']);
				$this->Path['Method'] = '_404';
				new $this->Path['Controller']($this->Path['Method'], $this->Path['Args']);
			}

		}

		//Load controller
		Autoload::Controller($this->Path['Controller']);

		//Run controller
		new $this->Path['Controller']($this->Path['Method'], $this->Path['Args']);
	}

	/**
	 * Check if controller exists
	 */
	public function existsController(string $Controller) : bool {
		$ControllerFile = ROOT.'/modules/'.Core::format_ucfirst($Controller).'/Controllers/Controller.php';

		return $result = file_exists($ControllerFile) ? true : false;
	}

	/**
	 * Check if method exists and set it
	 */
	public function getMethod(string $Method) : void {
		//check if method exists
		if ( method_exists($this->Path['Controller'], Core::format_ucfirst($Method)) ){
			$this->Path['Method'] = Core::format_ucfirst($Method);
		} 
	}

	/**
	 * Check and assign args
	 */
	public function getArgs(array $Uri) : void {
		if(count($Uri) > 2) {
			unset($Uri[0]);
			unset($Uri[1]);
			$this->Path['Args'] = implode(', ',$Uri);
		}
	}

	/**
	 * Route API Requests
	 */
	public function routeApi()
	{
		echo 'Api is not yet implemented';
	}
}