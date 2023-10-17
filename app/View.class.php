<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */
namespace App;

/*
* View class
* Class to control all views
*/

class View {

   public function __construct(string $File, string $Args)
   {
      $this->Render($File,$Args);
   }

   public static function Render(string $File, string $Args){
      if(file_exists($File)) {
         ob_start();
         //Header::set($mime);
         //Header::cache($file);
         print file_get_contents($File);
         ob_flush();
      } else {
         show('View file was not found!');
      }
   }
}