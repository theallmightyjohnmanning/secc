<?php
namespace SECC\Database;

/**
*
*/

use Illuminate\Database\Capsule\Manager as Capsule;

class roles
{
	public function up()
	{
		Capsule::schema()->create('roles', function($table) {
			
			$table->increments('id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Capsule::schema()->drop('roles');
	}
}
