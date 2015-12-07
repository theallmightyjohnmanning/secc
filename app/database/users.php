<?php
namespace SECC\Database;

/**
*
*/

use Illuminate\Database\Capsule\Manager as Capsule;

class users
{
	public function up()
	{
		Capsule::schema()->create('users', function($table) {
			
			$table->increments('id');
			$table->timestamps();
		});
	}

	public function down()
	{
		Capsule::schema()->drop('users');
	}
}
