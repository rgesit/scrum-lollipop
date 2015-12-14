<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function index()
    {
    	return view('index');
    }

    public function aboutme()
    {
    	echo 'About me';
    }
}
