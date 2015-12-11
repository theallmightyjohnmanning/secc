<?php
/**
*
*/

namespace SECC\Models\Services;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

class Database extends Capsule
{
	protected static $capsule;
	protected static $instance = null;

	public function __construct()
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
		self::$capsule = new Capsule;
		self::$capsule->addConnection([

			'driver'	=> Config::get('db.driver'),
			'host'		=> Config::get('db.host'),
			'database'	=> Config::get('db.name'),
			'username'	=> Config::get('db.username'),
			'password'	=> Config::get('db.password'),
			'charset'	=> Config::get('db.charset'),
			'collation'	=> Config::get('db.collation'),
			'prefix'	=> Config::get('db.prefix')
		]);

		self::$capsule->setEventDispatcher(new Dispatcher(new Container));
		self::$capsule->setAsGlobal();
		self::$capsule->bootEloquent();
	}
}