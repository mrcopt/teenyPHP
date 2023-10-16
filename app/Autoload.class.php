<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */
namespace App;

/**
 * Autoloader class
 */
class Autoload {
   public function __construct()
   {
      // Load core application classes
      require_once 'Core.class.php';
      require_once 'Router.class.php';
      require_once 'Controller.class.php';
      require_once 'View.class.php';
      //require_once 'Header.class.php';
      //require_once 'Mimetype.class.php';

      // Load extensions classes
      //$this->Extensions();
   }

   public function Extensions()
   {
      // Extensions autoloaders
      require_once 'extensions/PlatesPHP/Autoload.php';
   }

   public static function Controller(string $Name) : void
   {
      $ControllerFile = ROOT.'/modules/'.$Name.'/Controllers/Controller.php';
      require_once $ControllerFile;
   }
}