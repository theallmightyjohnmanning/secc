<?php
/**
*
*/

namespace SECC\Models\Accessors;

use Illuminate\Database\Eloquent\Model as Eloquent;

class User extends Eloquent
{

	protected $table 		= 'users';
	protected $fillable 	= [

		'created_at',
		'updated_at'
	];

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
}