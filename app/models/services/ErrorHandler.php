<?php

/**
*
*/

namespace SECC\Models\Services;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class ErrorHandler
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
	
	public static function initialize()
	{
		$whoops = new Run;
		$handler = new PrettyPageHandler;

		$whoops->pushHandler($handler)->register();
	}
}