<?php
/**
*
*/

namespace SECC\Models\Services;

class File
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
	
	public static function mkdir($path)
	{
		if(is_dir($path)) return true;
		$prev_path = substr($path, 0, strrpos($path, '/', -2) + 1);
		$return = self::mkdir($prev_path);
		return ($return && is_writable($prev_path)) ? mkdir($path) : false;
	}
}