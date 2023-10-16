<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */

/** Start new or resume existing session */
//session_start();

/** Set-up the directory variables */
define('ROOT', getcwd());

/** Adds the autoloader */
require (ROOT . '/app/init.php');