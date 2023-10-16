<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */
namespace App;

use App\Router;

/** 
 * App main class 
 */
class Core {
	
	// CSRF field name on HTML
  const CSRF_FIELD = '_csrf';
  
	// All request methods allowed
  const REQUEST_ALLOWED = ['POST', 'GET', 'HEAD', 'PUT', 'DELETE'];
   
  // Common proxy headers
  const PROXY_HEADERS = [
		'HTTP_VIA','VIA','Proxy-Connection','HTTP_FORWARDED_FOR','HTTP_X_FORWARDED',
		'HTTP_FORWARDED','HTTP_CLIENT_IP','HTTP_FORWARDED_FOR_IP','X-PROXY-ID',
    'MT-PROXY-ID','X-TINYPROXY','X_FORWARDED_FOR','FORWARDED_FOR','X_FORWARDED',
    'FORWARDED','CLIENT-IP','CLIENT_IP','PROXY-AGENT','HTTP_X_CLUSTER_CLIENT_IP',
		'FORWARDED_FOR_IP','HTTP_PROXY_CONNECTION'
  ];

  // Some user-agents for mobile detection
  const MOBILE_UA = [
    '/iphone/i' => 'iPhone', 
    '/ipod/i' => 'iPod', 
    '/ipad/i' => 'iPad', 
    '/android/i' => 'Android', 
    '/blackberry/i' => 'BlackBerry', 
    '/webos/i' => 'Mobile'
  ];

	// Run the app
	public function __construct()
	{
		new Router;
	}

	// Removing slash from strings
	public static function removeSlashes(string $url): string {
		return trim($url, '/');
	}

	// Return current URL in an array
	public static function getUrlArray() : array {
		return $URL = explode('/', self::removeSlashes($_SERVER['REQUEST_URI']) ) ;
	}

	// Return string formatted in first letter uppercase
	public static function format_ucfirst(string $String) : string {
		return $String = ucfirst(strtolower($String));
	}

	// Load all classes
	public static function loadClasses(): array {
		return self::rglob(DIRECTORY . SEPARATOR . 'app' . SEPARATOR . 'classes' . SEPARATOR . '*.php');
	}

	//Load all functions
	public static function loadFunctions(): array {
		return self::rglob(DIRECTORY . SEPARATOR . 'app' . SEPARATOR . 'functions' . SEPARATOR . '*.php');
	}

	//Load all vendor files
	public static function loadVendor(): array {
		return self::rglob(DIRECTORY . SEPARATOR . 'vendor' . SEPARATOR . '*.class.php');
	}
	
	// Detect and store the browser language
	public static function setLanguage(): string {
		$lang = self::detectLanguage();
		require_once(DIRECTORY . SEPARATOR . 'app' . SEPARATOR . 'lang' . SEPARATOR . $lang . '.php');
		setCookie('lang', $lang, strtotime('+10 years'));
		return $lang;
	}
	
	// Disallow direct access to certain folders and files
	public static function isForbidden(array $values) {
		$directory = explode('/', $_SERVER['SCRIPT_NAME']);
			if (empty($directory[1])) {
					return false;
			}
			if (in_array($directory[1], $values)) {
					http_response_code(403);
					exit;
			}
			return true;
	}

	// Detect if the browser is mobile
	public static function isMobile() {
		if (!array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
			return false;
		}
		foreach(self::MOBILE_UA as $regex => $os) {
			if(preg_match($regex, $_SERVER['HTTP_USER_AGENT'])) {
				return $os;
			}
		}
		return false;
	}
	
	// Get the user IP
	public static function getIp(): string {
		return array_key_exists("HTTP_CF_CONNECTING_IP", $_SERVER) 
			? $_SERVER["HTTP_CF_CONNECTING_IP"] 
			: $_SERVER['REMOTE_ADDR'];
	}
	
	// Detect if the request is from a bot
	public static function isBot(): bool {
		if (!array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
			return false;
		}
		return (preg_match('/bing|google|bot|spider/i', $_SERVER['HTTP_USER_AGENT']));
	}
	
	// Detect if the request is from a real user
	public static function isRealUser(): bool {
		if (!array_key_exists('HTTP_USER_AGENT', $_SERVER)) {
			return false;
		} else if (strlen($_SERVER['HTTP_USER_AGENT']) < 15) {
			return false;
		} else if (!self::isBot()) {
			$name  = md5(self::getIp());
			$token = sha1(self::getIp());
			$_SESSION[$name] = $token;
			if (!array_key_exists($name, $_SESSION)) {
				return false;
			} else if ($_SESSION[$name] != $token) {
				return false;
			}
		}
		return true;
	}
	
	// Generates a CSRF token
	public static function doCSRF($level = 3): string { // default is 3
		switch ($level) {
			case 2:
				$token = base64_encode(self::randomAlias(45));
				break;
			case 3:
				$token = self::randomAlias(45) . md5(time());
				break;
			default:
				$token = sha1(microtime(true));
				break;
		}
		self::newSession(md5(self::getIp()), $token);
		return $token;
	}
	
	// Get the CSRF token
	public static function getCSRF() {
		return self::getSession(md5(self::getIp()));
	}

	// Create a new session on the server
	public static function newSession(string $name, string $value): bool {
			$dir  = DIRECTORY . SEPARATOR . 'app' . SEPARATOR . 'sessions';
			$file = SEPARATOR . $name . '.txt';
			if (!is_writable($dir)) {
					chmod($dir, 0644);
			}
			return file_put_contents(
					$dir . $file, 
					strip_tags($value)
			);
	}
	
	// Get a session from the server
	public static function getSession(string $name) {
			$dir  = DIRECTORY . SEPARATOR . 'app' . SEPARATOR . 'sessions';
			$file = SEPARATOR . $name . '.txt';
			if (!is_readable($dir)) {
					chmod($dir, 0644);
			} else if (!file_exists($dir . $file)) {
					return null;
			}
			return file_get_contents($dir . $file);
	}
	
	// Just display the CSRF on HTML
	public static function inputCSRF() {
			print '<input type="hidden" name="' . self::CSRF_FIELD . '" value="' . self::doCSRF() . '" />';
	}
	
	// Generates random letters and numbers
	public static function randomAlias(int $size): string {
			$result = null;
			$random = array_merge(
					range(0, 9),
					range('a', 'z'),
					range('A', 'Z')
			);
			for ($i = 1; $i <= $size; $i++) {
					$result .= $random[array_rand($random)];
			}
			return $result;
	}
	
	// Get all files in the directory and sub-directories 
	public static function rglob($pattern, $flags = 0): array {
		$files = glob($pattern, $flags); 
		foreach (glob(dirname($pattern) . '/*', GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
				$files = array_merge($files, self::rglob($dir . '/' . basename($pattern), $flags));
		}
		return $files;
	}

















	/*
	//Setting the defaults
	private $controller = 'Kickstart'; //Default controller
	private $method 	= 'init'; //Default method

	// Load the desired controller based on URL
	public function initialize() {
		
		// Get the URL
		$URL = $this->getURL();
		// Get struture
		$structure = $this->structure($URL[1]);
		// Select the controller
		require $structure['path'];
		$this->controller = $structure['name'];
		unset($URL[1]);		
		// Select the method
		if(!empty($URL[2])) {
			if(method_exists($this->controller, $URL[2])) {
				$this->method = $URL[2]; //Select the method
			}
			unset($URL[2]);
		}
		//New controller object
		$controller = new $this->controller;

		//Prepare URI arguments
		$args = $URL;
		$args['path'] = str_replace($this->controller.'.php','' ,$structure['path']);
		$args = implode('|',$args);
		
		//Call function
		call_user_func(
			array($controller,$this->method),
			$args
		);

	}
	*/
}