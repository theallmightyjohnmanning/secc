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
}