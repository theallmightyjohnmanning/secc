<?= '<?php' ?>

/**
*
*/

namespace SECC\Models\Accessors;

use Illuminate\Database\Eloquent\Model as Eloquent;

class {{$name}} extends Eloquent
{

	protected $table 		= '{{ strtolower($name) }}s';
	protected $fillable 	= [

		'created_at',
		'updated_at'
	];
}