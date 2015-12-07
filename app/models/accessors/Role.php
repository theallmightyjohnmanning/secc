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
}