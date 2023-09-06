<?php
/**
 * @package  teenyPHP
 * @version  0.1.0
 * @todo	 
 */


/*
* Entry Class
* Class for the Entry controller
*/

class Entry {
	use Controller;

	//Initialize function of the Entry class
	public function init() {
		$this->view('entry');
	}
}