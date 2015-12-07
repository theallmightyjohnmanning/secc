<?php
/**
* 
*/

namespace SECC\Commands;

use SECC\App;

class route
{
	public static function help()
	{
		Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the route you would like to create.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");

		echo "\n";

		Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the route that you would like to delete.\n", "green");
		Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");

		echo "\n";
		Shell::write(" ls - ", "cyan") . Shell::write("Lists all routes registered in the application. \n", "green");
	}

	public function make($name = null, $type = null)
	{
		if(!$name)
		{
			Shell::write(" make - ", "cyan") . Shell::write("Enter the name of the route you would like to create.");
			Shell::write(" Example = ", "purple") . Shell::write("make:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if(!$type)
			{
				$this->create_route($name, "empty");
			}
			else
			{
				$this->create_route($name, $type);
			}
		}
	}

	private function create_route($name, $type)
	{
		$container = json_decode(file_get_contents('app/containers/routes.json'));

		if(!in_array($name, $container->routes))
		{
			$container->routes[] = $name;

			switch($type)
			{
				case 'empty':
					$fields = ['path', 'controller', 'method'];
					$properties = [];

					$run = true;
					while($run)
					{
						if(Shell::input() == 'exit')
						{
							$run = false;
						}

						for($i = 0; $i < count($fields); $i++)
						{
							Shell::write("Enter the name of the ".$fields[$i]." that you wish to give this route. \n", 'light_blue');
							Shell::write(">>", 'yellow');
							Shell::set_input(trim(fgets(STDIN, 1024)));

							$properties[] = Shell::input();

							if($i == count($fields)-1)
							{
								$final = array_combine($fields, $properties);
								$final[] = ['name' => $name];

								$final = (object)($final);

								$template = App::service('View')->make('templates.code.route.route-empty', [


									'name'			=> $name,
									'path'			=> $final->path,
									'controller'	=> $final->controller,
									'method'		=> $final->method
								]);

								file_put_contents('app/routes/'.$name.'.json', $template);
								file_put_contents('app/containers/routes.json', json_encode($container));
								Shell::write("The route $name has been successfully created \n", 'green');
								$run = false;
							}
						}
					}
				break;
			}
		}
		else
		{
			Shell::write("That route already exists. \n", 'red');
		}
	}

	public function delete($name = null)
	{
		if(!$name)
		{
			Shell::write(" delete - ", "cyan") . Shell::write("Enter the name of the route that you would like to delete.\n", "green");
			Shell::write(" Example = ", "purple") . Shell::write("delete:", "yellow") . Shell::write("name\n", "red");
		}
		else
		{
			if(!file_exists('app/routes/'.$name.'.json'))
			{
				Shell::write("No route by that name. \n", 'red');
			}
			else
			{
				$container = json_decode(file_get_contents('app/containers/routes.json'));

				for($i = 0; $i < count($container->routes); $i++)
				{
					if($container->routes[$i] == $name)
					{
						unset($container->routes[$i]);
						file_put_contents('app/containers/routes.json', json_encode($container));
						unlink('app/routes/'.$name.'.json');
						Shell::write("Route successfully deleted. \n", 'green');
					}
				}
			}
		}
	}

	public function ls()
	{
		$routes = scandir('app/routes');

		for($i = 0; $i < count($routes); $i++)
		{
			if($routes[$i] != '.' || $routes[$i] != '..')
			{
				$routes[$i] = explode('.', $routes[$i]);
				Shell::write($routes[$i][0]."\n", "purple");
			}
		}
	}
}
