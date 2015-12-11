<?php
/**
*
*/

namespace SECC\Models\Accessors;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Role extends Eloquent
{

	protected $table 		= 'roles';
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