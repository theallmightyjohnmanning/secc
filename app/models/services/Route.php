<?php
/**
*
*/

namespace SECC\Models\Services;

class Route
{
	protected static $url 		= [];
	protected static $routes	= [];
	protected static $params 	= [];

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

	public static function get_url()
	{
		(Input::get('url')) ? self::$url[] = Input::get('url') : self::$url[] = '/';
	}

	public static function initialize()
	{
		self::get_url();
		$url = self::$url[0];

		$routes_container = scandir('../app/routes');

		$route = [];

		for($i = 0; $i < count($routes_container); $i++)
		{
			if($routes_container[$i] != '.' && $routes_container[$i] != '..')
				$routes[] = json_decode(file_get_contents('../app/routes/'.$routes_container[$i]));
		}

		self::$routes[] = $routes;

		for($i = 0; $i < count($routes); $i++)
		{
			$route = (object)($routes[$i]);
			self::$params = preg_match_all('/{(.*?)}/', $route->path, $matches) ? array_values($matches[1]) : [];

			if(!empty(self::$params))
			{
				$url_array = explode('/', Input::get('url'));

				self::$params = array_reverse(self::$params);
				$url_array = array_reverse($url_array);

				for($i = 0; $i < count(self::$params); $i++)
				{
					if(isset($url_array[$i]))
					{
						self::$params[$i] = $url_array[$i];
					}
				}

				self::$params = array_reverse(self::$params);
				$url_array = array_reverse($url_array);

				$full_path = [];

				$full_path = array_unique(array_merge($url_array, self::$params));
				$full_path = implode('/', $full_path);

				$route->path = $full_path;
			}

			if(preg_match("#^$url$#", $route->path))
			{
				$controller = 'SECC\\Controllers\\'.$route->controller;

				if(count(self::$params))
				{
					if(isset($route->filters))
					{
						$check = [];
						for($i = 0; $i < count($route->filters); $i++)
						{
							$route->filters[$i] = 'SECC\\Models\\Filters\\'.$route->filters[$i];
							$route->filters[$i] = new $route->filters[$i];

							if($route->filters[$i]->main())
							{
								array_push($check, $route->filters[$i]);
							}
						}

						if(count($check) == count($route->filters))
						{
							$controller = new $controller;
							return call_user_func_array([$controller, $route->method], self::$params);
						}
						else
						{
							return Redirect::to(401);
						}
					}

					$controller = new $controller;
					return call_user_func_array([$controller, $route->method], self::$params);
				}

				if(isset($route->filters))
				{
					$check = [];
					for($i = 0; $i < count($route->filters); $i++)
					{
						$route->filters[$i] = 'SECC\\Models\\Filters\\'.$route->filters[$i];
						$route->filters[$i] = new $route->filters[$i];

						if($route->filters[$i]->main())
						{
							array_push($check, $route->filters[$i]);
						}
					}

					if(count($check) == count($route->filters))
					{
						$controller = new $controller;
						return call_user_func_array([$controller, $route->method], self::$params);
					}
					else
					{
						return Redirect::to(401);
					}
				}

				$controller = new $controller;
				return $controller->{$route->method}();
			}
		}

		foreach(self::$routes as $routes)
		{
			foreach($routes as $route)
			{
				$route = (object)($route);
				if(!preg_match("#^$url$#", $route->path))
				{
					return Redirect::to(404);
				}
			}
		}
	}

	public static function url($name)
	{
		foreach(self::$routes as $routes)
		{
			foreach($routes as $route)
			{
				$route = (object)($route);
				if(preg_match("#^$name$#", $route->name))
				{
					return $route->path;
				}
			}
		}
	}
}