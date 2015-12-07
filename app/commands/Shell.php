<?php

/**
* 
*/

namespace SECC\Commands;

class Shell
{
	private static $input;

	private static $text_colors 		= [];
	private static $background_colors 	= [];

	private static function initialize()
	{
		// Set up shell colors
		self::$text_colors['black'] = '0;30';
		self::$text_colors['dark_grey'] = '1;30';
		self::$text_colors['blue'] = '0;34';
		self::$text_colors['light_blue'] = '1;34';
		self::$text_colors['green'] = '0;32';
		self::$text_colors['light_green'] = '1;32';
		self::$text_colors['cyan'] = '0;36';
		self::$text_colors['light_cyan'] = '1;36';
		self::$text_colors['red'] = '0;31';
		self::$text_colors['light_red'] = '1;31';
		self::$text_colors['purple'] = '0;35';		
		self::$text_colors['light_purple'] = '1;35';
		self::$text_colors['brown'] = '0;33';
		self::$text_colors['yellow'] = '1;33';
		self::$text_colors['light_grey'] = '0;37';
		self::$text_colors['white'] = '1;37';

		// Set up background colors
		self::$background_colors['black'] = '40';
		self::$background_colors['red'] = '41';
		self::$background_colors['green'] = '42';
		self::$background_colors['yellow'] = '43';
		self::$background_colors['blue'] = '44';
		self::$background_colors['magenta'] = '45';
		self::$background_colors['cyan'] = '46';
		self::$background_colors['light_grey'] = '47';
	}

	public static function write($string, $forground_color = null, $background_color = null)
	{
		self::initialize();
		$colored_string = "";

		// Check if the forground color exists
		if(isset(self::$text_colors[$forground_color]))
		{
			$colored_string .= "\033[" . self::$text_colors[$forground_color] . "m";
		}

		// Check if the background color exists
		if(isset(self::$background_colors[$background_color]))
		{
			$colored_string .= "\033[" . self::$background_colors[$background_color] . "m";
		}

		// Add string and end coloring
		$colored_string .= $string . "\033[0m";
		echo $colored_string;
	}

	public static function input()
	{
		return self::$input;
	}

	public static function set_input($string)
	{
		self::$input = $string;
	}
}
