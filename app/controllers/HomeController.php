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
}
