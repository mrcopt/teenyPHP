<?php
/**
 * @package  teenyPHP
 * @version  0.1.0
 * @todo	 
 */


/*
* 404 Class
* Class for the 404 controller
*/

class _404 {
	use Controller;
	
	public function init() {
		$this->view('404');
	}
}
