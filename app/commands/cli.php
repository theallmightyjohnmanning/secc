<?php

/**
* 
*/

namespace SECC\Commands;

use SECC\App;

class cli
{
	public static function help()
	{
		Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the command you would like to create.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");

		echo "\n";

		Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the command that you would like to delete.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
	}

	public function make($name = null, $type = 'empty')
	{
		if(file_exists("app/commands/".$name.".php"))
		{
			Shell::write("$name already exists! \n", "red");
		}
		else
		{
			if(!$name)
			{
				Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the command you would like to create.\n", "green");
				Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");				
			}
			else
			{
				switch ($type)
				{
					case 'empty':
						$command_template = App::service('View')->make('templates.code.command.command-empty', [

							'name'	=> $name
						]);
						file_put_contents('app/commands/'.$name.'.php', $command_template);
						Shell::write("Command created successfully! \n", 'green');
					break;
				}
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
			if(!file_exists('app/commands/'.$name.'.php'))
			{
				Shell::write("$name doesn't exist. \n", "red");
			}
			else
			{
				
				unlink('app/commands/'.$name.'.php');
				Shell::write("Command successfully deleted. \n", 'green');
			}
		}
	}
}
