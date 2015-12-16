<?php

namespace App\Http\Controllers;
 
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class YoseController extends Controller{

	public function minesweeper(Request $request){
		if($request->getMethod() == 'POST') {
			
		}
	
		return view('minesweeper', ['cell' => 3, 'row'=> 6]);
	}

	public function ping()
	{
		$data = array(
			'alive' => true
		);
		return response($data)->header('Content-Type', 'application/json');
	}

	public function astroport($id = null)
	{
		return view('astroport', array('id' => $id));
	}
	
	public function fire(Request $request)
	{
		$width = $request->input('width');
		$map = $request->input('map');

		$map_arr[] = array();
		// change map representation
		$count = 0;
		for ($i=0;$i < $width;$i++) {
			$map_arr[$i] = array();
			for ($j=0;$j < $width;$j++) {
				$map_arr[$i][$j] = $map[$count];
				$count++;
			}
		}
		$plane_loc_x = 0;
		$plane_loc_y = 0;
		$water_loc_x = 0;
		$water_loc_y = 0;
		$fire_loc_x = 0;
		$fire_loc_y = 0;
		// search for all object location
		for ($i=0;$i < $width;$i++) {
			for ($y=0;$y < $width;$y++) {
				if ($map_arr[$i][$y] === "P") {
					$plane_loc_x = $i;
					$plane_loc_y = $y;
				}
				if ($map_arr[$i][$y] === "W") {
					$water_loc_x = $i;
					$water_loc_y = $y;					
				}
				if ($map_arr[$i][$y] === "F") {
					$fire_loc_x = $i;
					$fire_loc_y = $y;					
				}
			}			
		}
		//  map: [
        //  "...",
		//  "P..",
		//  ".WF"
		//  ],
		// from plane location search for water
		$diff_plane_water_x = $water_loc_x - $plane_loc_x;
		$diff_plane_water_y = $water_loc_y - $plane_loc_y;
		$diff_water_fire_x = $fire_loc_x - $water_loc_x;
		$diff_water_fire_y = $fire_loc_y - $water_loc_y;
		//print_r($diff_plane_water_x);
		//print_r($diff_plane_water_y);

		// moves: [
		//		{ dx: 0, dy: 1 },
		//		{ dx: 1, dy: 0 },
		//		{ dx: 1, dy: 0 },
		//	]
		$moves = array();
		for ($x=0;$x < abs($diff_plane_water_x);$x++) {
			if ($diff_plane_water_x > 0) {
				$moves[] = array('dx' => 0, 'dy' => 1);
			}
			else if ($diff_plane_water_x < 0) {
				$moves[] = array('dx' => 0, 'dy' => -1);				
			}
		}
		for ($y=0;$y < abs($diff_plane_water_y);$y++) {
			if ($diff_plane_water_y > 0) {
				$moves[] = array('dx' => 1, 'dy' => 0);
			}
			else if ($diff_plane_water_y < 0) {
				$moves[] = array('dx' => -1, 'dy' => 0);				
			}
		}
		for ($x=0;$x < abs($diff_water_fire_x);$x++) {
			if ($diff_water_fire_x > 0) {
				$moves[] = array('dx' => 0, 'dy' => 1);
			} 
			else if ($diff_water_fire_x < 0) {
				$moves[] = array('dx' => 0, 'dy' => -1);				
			}
		}
		for ($y=0;$y < abs($diff_water_fire_y);$y++) {
			if ($diff_water_fire_y > 0) {
				$moves[] = array('dx' => 1, 'dy' => 0);
			}
			else if ($diff_water_fire_y < 0) {
				$moves[] = array('dx' => -1, 'dy' => 0);
			}
		}
		$map_result = array();
		for ($i=0;$i < $width;$i++) {
			$map_result[$i] = implode("", $map_arr[$i]);
		}
		$all = array("map" => $map_result, "moves" => $moves);
        return response()->json($all);
	}
}