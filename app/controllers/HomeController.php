<?php
/**
*
*/

namespace SECC\Controllers;

use SECC\App;

class HomeController
{
	public function index()
	{
		App::service('View')->render('templates.frontend.pages.home');
	}

	public function test()
	{
		$token = App::service('Token')->generate();
		App::service('View')->render('templates.frontend.pages.test', [

			'token'	=> $token
		]);

		if(App::service('Input')->post('name') != null)
		{
			echo App::service('Input')->post('name');
		}
	}
}
