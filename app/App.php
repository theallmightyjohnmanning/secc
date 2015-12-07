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
		if($_SERVER['PHP_SELF'] == 'lace')
			$container = file_get_contents("app/containers/accessors.json");
		else
			$container = file_get_contents("../app/containers/accessors.json");

		$container = json_decode($container);

		for($i = 0; $i < count($container->accessors); $i++)
		{
			$container->accessors[$i] = trim($container->accessors[$i]);
			$container->accessors[$i] = 'SECC\\Models\\Accessors\\'.$container->accessors[$i];
			$container->accessors[$i] = new $container->accessors[$i];
		}

		foreach($container->accessors as $accessor)
		{
			if(strpos(get_class($accessor), $class))
			{
				return $accessor;
			}
		}
	}

	public static function service($class)
	{
		if($_SERVER['PHP_SELF'] == 'lace')
			$container = file_get_contents("app/containers/services.json");
		else
			$container = file_get_contents("../app/containers/services.json");

		$container = json_decode($container);

		for($i = 0; $i < count($container->services); $i++)
		{
			$container->services[$i] = trim($container->services[$i]);
			$container->services[$i] = 'SECC\\Models\\Services\\'.$container->services[$i];
			$container->services[$i] = new $container->services[$i];
		}

		foreach($container->services as $service)
		{
			if(strpos(get_class($service), $class))
			{
				return $service;
			}
		}
	}
}
