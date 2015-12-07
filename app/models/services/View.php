<?php

/**
* 
*/

namespace SECC\Models\Services;

use duncan3dc\Laravel\BladeInstance;

class View
{
	protected static $blade;

	private static function instance($views = '../app/views', $cache = '../app/views/cache')
	{
		self::$blade = new BladeInstance($views, $cache);
	}

	public static function render($view, $data = null)
	{
		if($_SERVER['PHP_SELF'] == 'lace')
			self::instance('app/views');
		else
			self::instance('../app/views');

		if(!isset($data))
		{
			echo self::$blade->render($view);
		}
		else
		{
			echo self::$blade->render($view, $data);
		}
	}

	public static function error($view, $data = null)
	{
		if($_SERVER['PHP_SELF'] == 'lace')
			self::instance('app/views/errors');
		else
			self::instance('../app/views/errors');

		if(!isset($data))
		{
			echo self::$blade->render($view);
		}
		else
		{
			echo self::$blade->render($view, $data);
		}
	}

	public static function make($view, $data = null)
	{
		if($_SERVER['PHP_SELF'] == 'lace')
			self::instance('app/views');
		else
			self::instance('../app/views');

		if(!isset($data))
		{
			return self::$blade->make($view);
		}
		else
		{
			return self::$blade->make($view, $data);
		}
	}

	public static function mail($view, $data = null)
	{
		if($_SERVER['PHP_SELF'] == 'lace')
			self::instance('app/views/emails');
		else
			self::instance('../app/views/emails');

		if(!isset($data))
		{
			return self::$blade->make($view);
		}
		else
		{
			return self::$blade->make($view, $data);
		}
	}
}
