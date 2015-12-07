<?php
/**
* 
*/

namespace SECC\Commands;

use SECC\App;

class accessor
{
	public static function help()
	{
		Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the accessor you would like to create.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");

		echo "\n";

		Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the accessor that you would like to delete.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
	}

	public function make($name = null, $type = 'empty')
	{
		$accessors_base = 'app/models/accessors/';
		if(!$name)
		{
			Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the accessor you would like to create.");
			Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			switch($type)
			{
				case 'empty':
					if(file_exists($accessors_base.$name.'.php'))
					{
						Shell::write("A accessor with the name $name already exists. \n", 'red');
					}
					else
					{
						$template = App::service('View')->make('templates.code.accessor.accessor-empty', [

							'name' => $name
						]);

						$container = json_decode(file_get_contents('app/containers/accessors.json'));

						for($i = 0; $i < count($container->accessors); $i++)
						{
							$container->accessors[$i] = trim($container->accessors[$i]);
						}

						$container->accessors[] = $name;

						$container_template = App::service('View')->make('templates.code.accessor.accessors-container', [

							'accessors' => $container->accessors
						]);

						file_put_contents($accessors_base.$name.'.php', $template);
						file_put_contents('app/containers/accessors.json', $container_template);
						Shell::write("accessor successfully created \n", 'green');
					}
				break;
			}
		}
	}

	public function delete($name = null)
	{
		if(!$name)
		{
			Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the accessor that you would like to delete.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if(!file_exists('app/models/accessors/'.$name.'.php'))
			{
				Shell::write("No accessor by that name could be found \n", 'red');
			}
			else
			{
				$container = json_decode(file_get_contents('app/containers/accessors.json'));

				for($i = 0; $i < count($container->accessors); $i++)
				{
					$container->accessors[$i] = trim($container->accessors[$i]);

					if($container->accessors[$i] == $name)
					{
						$new_accessors_list = $container->accessors;
						unset($new_accessors_list[$i]);
						$container_template = App::service('View')->make('templates.code.accessor.accessors-container', [

							'accessors' => $new_accessors_list
						]);

						file_put_contents('app/containers/accessors.json', $container_template);
						unlink('app/models/accessors/'.$container->accessors[$i].'.php');
						Shell::write("accessor successfully deleted \n", 'green');
					}
				}
			}
		}
	}
}
