<?php
/**
* 
*/

namespace SECC\Commands;

use SECC\App;

class service
{
	public static function help()
	{
		Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the service you would like to create.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");

		echo "\n";

		Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the service that you would like to delete.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
	}

	public function make($name = null, $type = 'empty')
	{
		$services_base = 'app/models/services/';
		if(!$name)
		{
			Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the service you would like to create.");
			Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			switch($type)
			{
				case 'empty':
					if(file_exists($services_base.$name.'.php'))
					{
						Shell::write("A service with the name $name already exists. \n", 'red');
					}
					else
					{
						$template = App::service('View')->make('templates.code.service.service-empty', [

							'name' => $name
						]);

						file_put_contents($services_base.$name.'.php', $template);
						Shell::write("Service successfully created \n", 'green');
					}
				break;
			}
		}
	}

	public function delete($name = null)
	{
		if(!$name)
		{
			Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the service that you would like to delete.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if(!file_exists('app/models/services/'.$name.'.php'))
			{
				Shell::write("No service by that name could be found \n", 'red');
			}
			else
			{
				unlink('app/models/services/'.$name.'.php');
				Shell::write("Service successfully deleted \n", 'green');
			}
		}
	}
}
