<?php
/**
*
*/

namespace SECC\Models\Services;

class Session
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
	
	public static function exists($name)
	{
		return (isset($_SESSION[$name])) ? true : false;
	}

	public static function put($name, $value)
	{
		return $_SESSION[$name] = $value;
	}

	public static function get($name)
	{
		return (isset($_SESSION[$name])) ? $_SESSION[$name] : null;
	}

	public static function delete($name)
	{
		if(self::exists($name))
		{
			unset($_SESSION[$name]);
		}
	}

	public static function flash($name, $string = '')
	{
		if(self::exists($name))
		{
			$session = self::get($name);
			self::delete($name);
			return $session;
		}
		else
		{
			self::put($name, $string);
		}
	}
}