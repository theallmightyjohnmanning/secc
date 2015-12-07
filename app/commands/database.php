<?php
/**
* 
*/

namespace SECC\Commands;

use SECC\App;

use Illuminate\Database\Capsule\Manager as Capsule;

class database
{
	protected $capsule;
	public function __construct()
	{
		App::service('Database')->initialize();
	}

	public static function help()
	{
		Shell::write("MIGRATE \n", "light_grey");
		Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the database you would like to create. \n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");
		echo "\n";
		Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the database that you would like to delete.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		echo "\n";
		Shell::write(" up - ", "cyan") . Shell::write("Run up alone to push all migration blueprints to the database.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		echo "\n";
		Shell::write(" down - ", "cyan") . Shell::write("Run down alone to pull all migration blueprints from the database.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
	}

	public function migrate($type = null, $name = null)
	{
		if(!$type)
		{
			Shell::write("MIGRATE \n", "light_grey");
			Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the database you would like to create. \n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");
			echo "\n";
			Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the database that you would like to delete.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
			echo "\n";
			Shell::write(" up - ", "cyan") . Shell::write("Run up alone to push all migration blueprints to the database.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
			echo "\n";
			Shell::write(" down - ", "cyan") . Shell::write("Run down alone to pull all migration blueprints from the database.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if($type)
			{
				switch($type)
				{
					case 'make':
						$template = App::service('View')->make('templates.code.database.migration-empty', [
							'name'	=> $name
						]);

						file_put_contents('app/database/'.$name.'.php', $template);
						Shell::write("Migration successfully created \n", 'green');
					break;

					case 'delete':
						if(!$name)
						{
							Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the database that you would like to delete.\n", "green");
							Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
						}
						else
						{
							if(!file_exists('app/database/'.$name.'.php'))
							{
								Shell::write("No migration by that name could be found. \n", 'red');
							}
							else
							{
								unlink('app/database/'.$name.'.php');
								Shell::write("Migration successfully deleted. \n", 'green');
							}
						}
					break;

					case 'up':
						if($name)
						{
							$schema = 'SECC\\Database\\'.$name;
							$schema = new $schema;
							$action = $schema->up();

							Shell::write("Migration operation successfully completed. \n", 'green');
						}
						else
						{
							$table_schemas = scandir('app/database/');
							for($i = 2; $i < count($table_schemas); $i++)
							{
								$schema = pathinfo('app/databse/'.$table_schemas[$i]);
								$table_schemas[$i] = 'SECC\\Database\\'.$schema['filename'];
								$table_schemas[$i] = new $table_schemas[$i];
								$action = $table_schemas[$i]->up();

								Shell::write("Migration operation successfully completed. \n", 'green');
							}
						}
					break;

					case 'down':
						if($name)
						{
							$schema = 'SECC\\Database\\'.$name;
							$schema = new $schema;
							$action = $schema->down();
							
							Shell::write("Migration operation successfully completed. \n", 'green');
						}
						else
						{
							$table_schemas = scandir('app/database/');
							for($i = 2; $i < count($table_schemas); $i++)
							{
								$schema = pathinfo('app/databse/'.$table_schemas[$i]);
								$table_schemas[$i] = 'SECC\\Database\\'.$schema['filename'];
								$table_schemas[$i] = new $table_schemas[$i];
								$action = $table_schemas[$i]->down();

								Shell::write("Migration operation successfully completed. \n", 'green');
							}
						}
					break;
				}
			}
		}
	}

	public function delete($name = null)
	{
		if(!$name)
		{
			Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the database that you would like to delete.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			
		}
	}
}
