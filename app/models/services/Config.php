<?php
/**
*
*/

namespace SECC\Models\Services;

class Config
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
	
	public function get($name)
	{
		if($_SERVER['PHP_SELF'] == 'lace')
			$file = file_get_contents('environment.json');
		else
			$file = file_get_contents('../environment.json');

		$name = explode('.', $name);
		$file = json_decode($file);
		return $file->{$name[0]}->{$name[1]};
	}
}