<?php

/**
*
*/

namespace SECC\Models\Services;

use Whoops\Run;
use Whoops\Handler\PrettyPageHandler;

class ErrorHandler
{
	public static function initialize()
	{
		$whoops = new Run;
		$handler = new PrettyPageHandler;

		$whoops->pushHandler($handler)->register();
	}
}