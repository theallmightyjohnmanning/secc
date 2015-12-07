<?php
/**
*	Filter must have a main method and return a bool value.
*/

namespace SECC\Models\Filters;

use SECC\App;

class CSRF
{
	protected $csrf_key;

	public function main()
	{
		$this->csrf_key = App::service('Config')->get('csrf.session');

		if(App::service('Input')->exists())
		{
			return App::service('Token')->check(App::service('Input')->post('token'));
		}
		else
		{
			return true;
		}
		
		return false;
	}
}
