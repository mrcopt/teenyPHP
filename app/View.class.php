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

   public function __construct(string $Controller, string $View, string $Args)
   {
      $this->Render($Controller,$View,$Args);
   }

   public function Render(string $Controller, string $View, string $Args){
      $File = ROOT.'/modules/'.$Controller.'/Views/'.$View.'.view.php';

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

   /*
   public function Partial(string $Which)
   {
      ob_start();

      print file_get_contents($Which);
      ob_flush();
   }
   */

}