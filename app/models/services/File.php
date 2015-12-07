<?php
/**
*
*/

namespace SECC\Models\Services;

class File
{
	public static function mkdir($path)
	{
		if(is_dir($path)) return true;
		$prev_path = substr($path, 0, strrpos($path, '/', -2) + 1);
		$return = self::mkdir($prev_path);
		return ($return && is_writable($prev_path)) ? mkdir($path) : false;
	}
}