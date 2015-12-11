<?php
/**
*
*/

namespace SECC\Models\Services;

use RandomLib\Factory as RandomLib;

class Hash
{
	public static $factory;
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

	public static function password($password)
	{
		return password_hash($password, (int)(Config::get('hash.algo')), [

			'cost'	=> (int)(Config::get('hash.cost'))
		]);
	}

	public static function password_verify($password, $hash)
	{
		return password_verify($password, $hash);
	}

	public static function make($input)
	{
		return hash('sha256', $input);
	}

	public static function verify($stored, $user)
	{
		return hash_equals($stored, $user);
	}

	public static function random($length)
	{
		self::$factory = new RandomLib;
		$generator = self::$factory->getMediumStrengthGenerator();

		return $generator->generateString($length);
	}
}