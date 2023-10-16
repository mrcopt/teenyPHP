<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */

/*** Collection of usefull functions to use in the whole App development ***/

//Print code block <pre> of raw data passed
function show($data,$what = null) {
	if (isset($what)){
		print('<h3>'.$what.':</h3>');
		print('<pre>');
		print_r($data);
		print('</pre><br>');
	} else {
		print('<pre>');
		print_r($data);
		print('</pre><br>');
	}
}

//Escape the passed string
function esc($string) {
	return htmlspecialchars($string);
}