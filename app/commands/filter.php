<?php
/**
* 
*/

namespace SECC\Commands;

use SECC\App;

class filter
{
	public static function help()
	{
		Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the filter you would like to create.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");

		echo "\n";

		Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the filter that you would like to delete.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
	}

	public function make($name = null, $type = 'empty')
	{
		if(!$name)
		{
			Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the filter you would like to create.");
			Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			switch($type)
			{
				case 'empty':
					if(file_exists('app/models/filter/'.$name.'.php'))
					{
						Shell::write("That filter already exists. \n", 'red');
					}
					else
					{
						$template = App::service('View')->make('templates.code.filter.filter-empty', [

							'name' => $name
						]);

						file_put_contents('app/models/filters/'.$name.'.php', $template);
						Shell::write("Created filter successfully. \n", 'green');
					}
				break;
			}
		}
	}

	public function delete($name = null)
	{
		if(!$name)
		{
			Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the filter that you would like to delete.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if(!file_exists('app/models/filters/'.$name.'.php'))
			{
				Shell::write("No filter by that name could be found. \n", 'red');
			}
			else
			{
				unlink('app/models/filters/'.$name.'.php');
				Shell::write("Deleted filter successfully. \n", 'green');
			}
		}
	}
}
