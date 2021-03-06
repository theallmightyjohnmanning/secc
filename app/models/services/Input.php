<?php
/**
*
*/

namespace SECC\Models\Services;

class Input
{
	protected static $instance = null;

	private function __construct()
	{

	}

	public static function instance()
	{
		if(!isset(self::$instance))
			self::$instance = new self;
		return self::$instance;
	}
	
	public static function exists($type = 'post')
	{
		switch($type)
		{
			case 'post': return (!empty($_POST)) ? true : false; break;
			case 'get': return (!empty($_GET)) ? true : false; break;
			default: return false; break;
		}
	}

	public static function get($name)
	{
		return (isset($_GET[$name])) ? $_GET[$name] : '';
 	}

 	public static function post($name)
	{
		return (isset($_POST[$name])) ? $_POST[$name] : '';
 	}

 	public static function escape($string)
 	{
 		return htmlentities($string, ENT_QUOTES, 'UTF-8');
 	}
}