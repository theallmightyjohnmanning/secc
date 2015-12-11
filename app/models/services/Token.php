<?php
/**
*
*/

namespace SECC\Models\Services;

class Token
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
	
	public static function generate()
	{
		$token = Session::put(Config::get('csrf.session'), Hash::make(Hash::random(128)));
		return '<input type="hidden" id="token" name="token" value="'.$token.'">';
	}

	public static function check($token)
	{
		$tokenName = Config::get('csrf.session');

		if(Session::exists($tokenName) && $token === Session::get($tokenName))
		{
			Session::delete($tokenName);
			return true;
		}

		return false;
	}
}