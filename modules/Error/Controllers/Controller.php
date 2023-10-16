<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */

class Error 
{
   public function __construct()
   {
      $this->_404();
   }

   /**
    * 404 Error Method
    */
   public function _404(){
      show('This is from Error controller and _404 method','404');
   }
}