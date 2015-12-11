<?= '<?php' ?>

/**
* 
*/

namespace SECC\Commands;

use SECC\App;

class {!!$name!!}
{
	public static function help()
	{
		Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the {{$name}} you would like to create. \n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");

		echo "\n";

		Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the {{$name}} that you would like to delete.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
	}

	public function make($name = null, $type = 'empty')
	{
		if(!$name)
		{
			Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the {{$name}} you would like to create.");
			Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			switch($type)
			{
				case 'empty':

				break;
			}
		}
	}

	public function delete($name = null)
	{
		if(!$name)
		{
			Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the {{$name}} that you would like to delete.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			
		}
	}
}
