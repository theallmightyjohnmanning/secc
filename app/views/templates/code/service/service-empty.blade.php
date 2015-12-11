<?= '<?php' ?>

/**
*
*/

namespace SECC\Models\Services;

class {{$name}}
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
		
	}
}