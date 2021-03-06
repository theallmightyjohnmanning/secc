<?php
/**
*
*/

namespace SECC\Models\Services;

class Redirect
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
	
	public static function to($location = null)
	{
		if($location)
		{
			if(is_numeric($location))
			{
				switch($location)
				{
					case 401:
					header('HTTP/1.1 401 Unauthorized');
					View::error('401');
					exit();
					break;

					case 404:
					header('HTTP/1.0 404 Not Found');
					View::error('404');
					exit();
					break;
				}
			}

			header('Location: '.$location);
			exit();
		}
	}
}