<?php
/**
 * @package  teenyPHP
 * @version  0.1.1
 * @todo	 
 */


/*
* System Class
* Class for system checkup controller functionality
*/

class System {
	use Controller;
	
	public function init() {
		$this->view('system');
	}
	
}