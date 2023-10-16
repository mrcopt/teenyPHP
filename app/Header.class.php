<?php
/**
 * @package  teenyPHP
 * @version  0.0.1
 */
namespace App;

class Header {
		
	const CACHETIME = 2592000; // Cache time, by default it is one month
		
	// Set the Content-Type aka MimeType
	public static function set(string $type) {
		header('Content-Type: ' . $type);
	}

	// Redirect user to a new URL
	public static function location(string $url) {
		header('Location: ' . $url);
	}

	// Enable or disable Chrome XSS protection
	public static function xss(int $value) {
		header('X-XSS-Protection: '. $value);
	}
		
	// Refresh the page
	public static function refresh($sec = 0) {
		header('refresh: ' . $sec);
	}
		
	// Set Connection type, like Keep-Alive or closed
	public static function connection(string $value) {
		header('Connection: '. $value);
	}
		
	/**
	 * Set cache on the file, first request returns 200 (OK)
	 * Second request returns 304 (NOT MODIFIED)
	 * Add this before your code: if(Header::cache(__FILE__)) { exit; }
	 * It will check if the file is already cached, if not then cache it
	 * 
	 * @param  string $dir [Directory of the file]
	 * @return boolean
	 */
	public static function cache(string $dir) {
		$last = filemtime($dir); 
		$etag = md5_file($dir);
		header("Cache-Control: max-age=" . self::CACHETIME);
		header("Last-Modified: ".gmdate("D, d M Y H:i:s", $last)." GMT"); 
		header("Etag: " . $etag);
		if (!array_key_exists('HTTP_IF_NONE_MATCH', $_SERVER) || !array_key_exists('HTTP_IF_MODIFIED_SINCE', $_SERVER)) {
			return false;
		} else if (strtotime($_SERVER['HTTP_IF_MODIFIED_SINCE']) == $last && trim($_SERVER['HTTP_IF_NONE_MATCH']) == $etag) { 
			http_response_code(304);
			return true;
		}
		return false;
	}
}