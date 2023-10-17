<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */
namespace App\Router;

use App\Autoload;
use App\Helper;

//use App\Helper;

class Html {

   private $Path = [
		'Controller' => 'Start', // Holds the controller, defaults to controller Index
		'Method' => 'Default', // Holds the method, defaults to method Init
		'Args' => '' // Holds the arguments, if there are any, defaults to empty
	];

   public function __construct(array $Url)
   {
      $this->Route($Url);
   }

	/**
	 * Route HTML Requests
	 */
	public function Route(array $Uri)
	{
		//if URI not empty
		if (!empty($Uri[0])) {
			//check if controller exists
			if ($this->existsController($Uri[0])) {
				//set this controller
				$this->Path['Controller'] = Helper::format_ucfirst($Uri[0]);
				Helper::show($this->Path);
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
            return;
         } else {
				$this->Path['Controller'] = 'Error';
				Autoload::Controller($this->Path['Controller']);
				$this->Path['Method'] = '_404';
				new $this->Path['Controller']($this->Path['Method'], $this->Path['Args']);
            return;
			}
		}

		//Load controller
		Autoload::Controller($this->Path['Controller']);

		//Run controller
		new $this->Path['Controller']($this->Path['Method'], $this->Path['Args']);
      return;
	}

	/**
	 * Check if controller exists
	 */
	public function existsController(string $Controller) : bool {
		$ControllerFile = ROOT.'/modules/'.Helper::format_ucfirst($Controller).'/Controllers/Controller.php';

		return $result = file_exists($ControllerFile) ? true : false;
	}

	/**
	 * Check if method exists and set it
	 */
	public function getMethod(string $Method) : void {
		//check if method exists
		if ( method_exists($this->Path['Controller'], Helper::format_ucfirst($Method)) ){
			$this->Path['Method'] = Helper::format_ucfirst($Method);
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


}