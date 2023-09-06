<?php
/**
 * @package  teenyPHP
 * @version  0.1.0
 * @todo    
 */


//Start new or resume existing session
session_start();

//Load core application files
require "../app/core/_init.php";

//Check DEBUG constant status and act accordingly
DEBUG ? ini_set('display_errors', 1) : ini_set('display_errors', 0);

//Start new instance of App
$app = new App;

//Check what controller to run
$app->loadController();