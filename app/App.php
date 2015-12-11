<?php 

namespace SECC;

/**
* 
*/

class App
{
	
	public static function initialize()
	{
		session_cache_limiter(false);
		session_start();

		self::service('ErrorHandler')->initialize();
		self::service('Route')->initialize();
	}

	public static function accessor($class)
	{
		$accessor = 'SECC\\Models\\Accessors\\'.$class;
		if(class_exists($accessor))
			return $accessor::instance();
	}

	public static function service($class)
	{
		$service = 'SECC\\Models\\Services\\'.$class;
		if(class_exists($service))
			return $service::instance();
	}
}
