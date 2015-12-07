<?= '<?php' ?>

namespace SECC\Database;

/**
*
*/

use Illuminate\Database\Capsule\Manager as Capsule;

class {{$name}}
{
	public function up()
	{
		Capsule::schema()->create('{{$name}}', function($table) {
			
			$table->increments('id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Capsule::schema()->drop('{{$name}}');
	}
}
