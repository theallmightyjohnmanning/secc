<?php
/**
* 
*/

namespace SECC\Commands;

use SECC\App;

class view
{
	public static function help()
	{
		Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the view you would like to create.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");

		echo "\n";

		Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the view that you would like to delete.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
	}

	public function make($name = null, $type = 'empty')
	{
		$view_base = "app/views/";
		if(!$name)
		{
			Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the view you would like to create.");
			Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if(file_exists($view_base.$name.'.blade.php'))
			{
				Shell::write("That view already exists. \n", 'red');
			}
			else
			{
				switch($type)
				{
					case 'empty':
						$file = '';
						if(strpos($name, '/'))
						{
							$path = explode('/', $name);
							$path = array_reverse($path);
							$file = $path[0];
							$path = array_reverse($path);
							array_pop($path);

							$path = implode('/', $path);

							if(App::service('File')->mkdir($view_base.$path))
							{
								$template = App::service('View')->make('templates.code.view.view-empty');
								file_put_contents($view_base.$path.'/'.$file.'.blade.php', $template);
								Shell::write("Created view successfully. \n", 'green');
							}
						}
						else
						{
							$template = App::service('View')->make('templates.code.view.view-empty');
							file_put_contents($view_base.$name.'.blade.php', $template);
							Shell::write("Created view successfully. \n", 'green');
						}
					break;
				}
			}
		}
	}

	public function delete($name = null)
	{
		$view_base = "app/views/";
		if(!$name)
		{
			Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the view that you would like to delete.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if(file_exists($view_base.$name.'.blade.php'))
			{
				unlink($view_base.$name.'.blade.php');
				Shell::write("View successfully deleted. \n", 'green');
			}
			else
			{
				Shell::write("That view doesn't exist. \n", 'red');
			}
		}
	}
}
