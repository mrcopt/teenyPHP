<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */

//use App\Controller;

/**
 * Start Class
 */
class Start /*extends Controller*/
{
	public function __construct(string $Method, string $Args = null)
	{
		$this->$Method($Args);
	}
	
	public function Default(string $Args = null)
	{	
		\App\View::Render($this->File(get_class(),'Index'), $Args);
	}

	public function File(string $Controller, string $View) : string
	{
		$File = ROOT.'/modules/'.$Controller.'/Views/'.$View.'.view.php';
		return $File;
	}
}