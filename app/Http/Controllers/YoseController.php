<?php

namespace App\Http\Controllers;
 
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class YoseController extends Controller{

	public function minesweeper(Request $request){
	
		return view('minesweeper', ['cell' => rand(1,8), 'row'=> rand(1,8)]);
	}

	public function ping()
	{
		$data = array(
			'alive' => true
		);
		return response($data)->header('Content-Type', 'application/json');
	}

	public function astroport($name = 'lolipop')
	{
		return view('astroport', array('name' => $name));
	}
}