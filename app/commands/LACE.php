<?php

/**
* 
*/

namespace SECC\Commands;

use SECC\App;

class LACE
{
	private static $commands = [];

	public static function initialize($argc = null, $argv = null)
	{
		self::setValidCommands();

		if($argc == 1)
		{
			self::header();

			for($i = 0; $i < count(self::$commands); $i++)
			{
				echo "\n";
				Shell::write(self::$commands[$i]." \n", "light_green");
				$command = "SECC\\Commands\\".self::$commands[$i];
				$command = new $command;
				$command->help();
			}
		}

		if(isset($argv[1]))
		{
			if(!in_array($argv[1], self::$commands))
			{
				Shell::write('You need to enter a valid LACE command!', 'red');
			}
			else
			{
				$command = "SECC\\Commands\\".$argv[1];
				$command = new $command;

				if($argc > 2)
				{
					$methods = [];

					for($i = 0; $i < $argc - 2; $i++)
					{
						$methods[] = $argv[$i + 2];

						$params = [];

						if(strpos($methods[$i], ':'))
						{
							$argument = $methods[$i];
							$argument = explode(':', $argument);
							$method = $argument[0];
							unset($argument[0]);
							$params = $argument;

							if(count($params) > 0)
							{
								if(method_exists($command, $method))
								{
									call_user_func_array([$command, $method], $params);
								}
								else
								{
									Shell::write('That isn\'t a valid LACE command', 'red');
								}
							}
						}
						else
						{
							$command->{$methods[$i]}();
						}
					}
				}
				else
				{
					$command->help();
				}
			}
		}
	}

	public static function setValidCommands()
	{
		$container = json_decode(file_get_contents('app/containers/commands.json'));
		self::$commands = $container->commands;
	}

	public static function header()
	{
		$header = App::service('View')->make('templates.code.header');

		$colors = [

			"dark_grey",
			"red",
			"light_red",
			"yellow",
			"blue",
			"green",
			"light_green",
			"brown",
			"light_blue",
			"cyan",
			"purple",
			"light_purple",
			"white"
		];

		Shell::write($header."\n", $colors[rand(0, 12)]);
	}
}
