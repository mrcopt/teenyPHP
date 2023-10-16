<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */

// use App\Controller;
use App\View;

class Start /*extends Controller*/
{
   public function __construct(string $Method, string $Args = null)
   {
      $this->$Method($Args);
   }
   
	public function Default(string $Args = null){
      show('This is from Start controller and Default method','TEST');
      show($Args,'Args');

      $Controller = get_class();

      new View($Controller,'Index',$Args);
   }
   /*
   public function Render($View,$Args){
		
      $View = $path.'/views/'.$view.'.view.php';
      if(file_exists($file)) {
         require $file;
      } else {
         show('View file was not found!');
      }
   }
   */
}

