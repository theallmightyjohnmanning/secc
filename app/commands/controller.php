<?php
/**
* 
*/

namespace SECC\Commands;

use SECC\App;

class controller
{
	public static function help()
	{
		Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the controller you would like to create. \n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");

		echo "\n";

		Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the controller that you would like to delete.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
	}

	public function make($name = null, $type = 'empty')
	{
		$controller_base = "app/controllers/";

		if(!$name)
		{
			Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the controller you would like to create.");
			Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if(file_exists($controller_base.$name.'.php'))
			{
				Shell::write("A controller with that name already exists. \n", 'red');
			}
			else
			{
				switch($type)
				{
					case 'empty':
						$template = App::service('View')->make('templates.code.controller.controller-empty', [

							'name' => $name
						]);

						file_put_contents($controller_base.$name.'.php', $template);
						Shell::write("Successfully created controller. \n", 'green');
					break;
				}
			}
		}
	}

	public function delete($name = null)
	{
		$controller_base = "app/controllers/";

		if(!$name)
		{
			Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the controller that you would like to delete.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if(file_exists($controller_base.$name.'.php'))
			{
				unlink($controller_base.$name.'.php');
				Shell::write("Successfully deleted $name. \n", 'green');
			}
			else
			{
				Shell::write("No controller named $name exists. \n", 'red');
			}
		}
	}
}
