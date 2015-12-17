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
	
	private function do_hori_pivot($plane_loc_x, $plane_loc_y, $map) {
		if (!empty($map[$plane_loc_y][$plane_loc_x+1]))
			return array($plane_loc_x+1, $plane_loc_y);
		return array($plane_loc_x-1, $plane_loc_y);
	}
	
	private function do_vert_pivot($plane_loc_x, $plane_loc_y, $map) {
		if (!empty($map[$plane_loc_y+1][$plane_loc_x]))
			return array($plane_loc_x, $plane_loc_y+1);
		return array($plane_loc_x, $plane_loc_y-1);
	}
	
	private function approach_for_water($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, &$map, &$moves)
	{
		$map[$plane_loc_y][$plane_loc_x] = 'V';
		if ($diff_x > 0) {
			if (!empty($map[$plane_loc_y][$plane_loc_x+1]) && $map[$plane_loc_y][$plane_loc_x+1] != 'F' && 
				$map[$plane_loc_y][$plane_loc_x+1] != 'V') {
				$moves[] = array('dx' => 1, 'dy' => 0);
				$diff_x -= 1;
				$plane_loc_x += 1;
				$this->approach_for_water($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);
			} else {
				$new_loc = $this->do_vert_pivot($plane_loc_x, $plane_loc_y, $map);
				if ($map[$new_loc[1]][$new_loc[0]] != 'F' && $map[$new_loc[1]][$new_loc[0]] != 'V') {
					$moves[] = array('dx' => 0, 'dy' => $plane_loc_y - $new_loc[1] );
					$diff_y += $plane_loc_y - $new_loc[1];
					$plane_loc_x = $new_loc[0];
					$plane_loc_y = $new_loc[1];
					$this->approach_for_water($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);
				}
			}
		}
		if ($diff_x < 0) {
			if (!empty($map[$plane_loc_y][$plane_loc_x-1]) && $map[$plane_loc_y][$plane_loc_x-1] != 'F' && 
				$map[$plane_loc_y][$plane_loc_x-1] != 'V') {
				$moves[] = array('dx' => -1, 'dy' => 0);
				$diff_x += 1;
				$plane_loc_x -= 1;
				$this->approach_for_water($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);
			}
			else {
				$new_loc = $this->do_vert_pivot($plane_loc_x, $plane_loc_y, $map);
				if ($map[$new_loc[1]][$new_loc[0]] != 'F' && $map[$new_loc[1]][$new_loc[0]] != 'V') {
					$moves[] = array('dx' => 0, 'dy' =>  $plane_loc_y - $new_loc[1]);
					$diff_y += $plane_loc_y - $new_loc[1];
					$plane_loc_x = $new_loc[0];
					$plane_loc_y = $new_loc[1];
					$this->approach_for_water($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);
				}
			}
		}
		if ($diff_y > 0) {
			if (!empty($map[$plane_loc_y+1][$plane_loc_x]) && $map[$plane_loc_y+1][$plane_loc_x] != 'F' &&
				$map[$plane_loc_y+1][$plane_loc_x] != 'V') {
				$moves[] = array('dx' => 0, 'dy' => -1);
				$diff_y -= 1;
				$plane_loc_y += 1;
				$this->approach_for_water($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);				
			} else {
				$new_loc = $this->do_hori_pivot($plane_loc_x, $plane_loc_y, $map);
				if ($map[$new_loc[1]][$new_loc[0]] != 'F' && $map[$new_loc[1]][$new_loc[0]] != 'V') {
					$moves[] = array('dx' => $new_loc[0] - $plane_loc_x, 'dy' => 0);
					$diff_x -= $new_loc[0] - $plane_loc_x;
					$plane_loc_x = $new_loc[0];
					$plane_loc_y = $new_loc[1];
					$this->approach_for_water($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);				
				}
			}
		}
		if ($diff_y < 0) {
			if (!empty($map[$plane_loc_y-1][$plane_loc_x]) && $map[$plane_loc_y-1][$plane_loc_x] != 'F' &&
				$map[$plane_loc_y-1][$plane_loc_x] != 'V') {
				$moves[] = array('dx' => 0, 'dy' => 1);
				$diff_y += 1;
				$plane_loc_y -= 1;
				$this->approach_for_water($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);				
			} else {
				$new_loc = $this->do_hori_pivot($plane_loc_x, $plane_loc_y, $map);
				if ($map[$new_loc[1]][$new_loc[0]] != 'F' && $map[$new_loc[1]][$new_loc[0]] != 'V') {
					$moves[] = array('dx' => $plane_loc_x - $new_loc[0], 'dy' => 0);
					$diff_x += $plane_loc_x - $new_loc[0];
					$plane_loc_x = $new_loc[0];
					$plane_loc_y = $new_loc[1];				
					$this->approach_for_water($plane_loc_x, $plane_loc_y, $new_loc[0] - $plane_loc_x, 0, $map, $moves);
				}
			}
		}
	}
	
	private function approach_for_fire($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, &$map, &$moves)
	{
		$map[$plane_loc_y][$plane_loc_x] = 'V';
		if ($diff_x > 0) {
			if (!empty($map[$plane_loc_y][$plane_loc_x+1]) && 
				$map[$plane_loc_y][$plane_loc_x+1] != 'V') {
				$moves[] = array('dx' => 1, 'dy' => 0);
				$diff_x -= 1;
				$plane_loc_x += 1;
				$this->approach_for_fire($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);
			} else {
				$new_loc = $this->do_vert_pivot($plane_loc_x, $plane_loc_y, $map);
				if ($map[$new_loc[1]][$new_loc[0]] != 'V') {
					$moves[] = array('dx' => 0, 'dy' => $plane_loc_y - $new_loc[1] );
					$diff_y += $plane_loc_y - $new_loc[1];
					$plane_loc_x = $new_loc[0];
					$plane_loc_y = $new_loc[1];
					$this->approach_for_fire($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);
				}
			}
		}
		if ($diff_x < 0) {
			if (!empty($map[$plane_loc_y][$plane_loc_x-1]) && 
				$map[$plane_loc_y][$plane_loc_x-1] != 'V') {
				$moves[] = array('dx' => -1, 'dy' => 0);
				$diff_x += 1;
				$plane_loc_x -= 1;
				$this->approach_for_fire($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);
			}
			else {
				$new_loc = $this->do_vert_pivot($plane_loc_x, $plane_loc_y, $map);
				if ($map[$new_loc[1]][$new_loc[0]] != 'V') {
					$moves[] = array('dx' => 0, 'dy' =>  $plane_loc_y - $new_loc[1]);
					$diff_y += $plane_loc_y - $new_loc[1];
					$plane_loc_x = $new_loc[0];
					$plane_loc_y = $new_loc[1];
					$this->approach_for_fire($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);
				}
			}
		}
		if ($diff_y > 0) {
			if (!empty($map[$plane_loc_y+1][$plane_loc_x]) &&
				$map[$plane_loc_y+1][$plane_loc_x] != 'V') {
				$moves[] = array('dx' => 0, 'dy' => -1);
				$diff_y -= 1;
				$plane_loc_y += 1;
				$this->approach_for_fire($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);				
			} else {
				$new_loc = $this->do_hori_pivot($plane_loc_x, $plane_loc_y, $map);
				if ($map[$new_loc[1]][$new_loc[0]] != 'V') {
					$moves[] = array('dx' => $new_loc[0] - $plane_loc_x, 'dy' => 0);
					$diff_x -= $new_loc[0] - $plane_loc_x;
					$plane_loc_x = $new_loc[0];
					$plane_loc_y = $new_loc[1];
					$this->approach_for_fire($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);				
				}
			}
		}
		if ($diff_y < 0) {
			if (!empty($map[$plane_loc_y-1][$plane_loc_x]) &&
				$map[$plane_loc_y-1][$plane_loc_x] != 'V') {
				$moves[] = array('dx' => 0, 'dy' => 1);
				$diff_y += 1;
				$plane_loc_y -= 1;
				$this->approach_for_fire($plane_loc_x, $plane_loc_y, $diff_x, $diff_y, $map, $moves);				
			} else {
				$new_loc = $this->do_hori_pivot($plane_loc_x, $plane_loc_y, $map);
				if ($map[$new_loc[1]][$new_loc[0]] != 'V') {
					$moves[] = array('dx' => $plane_loc_x - $new_loc[0], 'dy' => 0);
					$diff_x += $plane_loc_x - $new_loc[0];
					$plane_loc_x = $new_loc[0];
					$plane_loc_y = $new_loc[1];				
					$this->approach_for_fire($plane_loc_x, $plane_loc_y, $new_loc[0] - $plane_loc_x, 0, $map, $moves);
				}
			}
		}

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
					$plane_loc_x = $y;
					$plane_loc_y = $i;
				}
				if ($map_arr[$i][$y] === "W") {
					$water_loc_x = $y;
					$water_loc_y = $i;					
				}
				if ($map_arr[$i][$y] === "F") {
					$fire_loc_x = $y;
					$fire_loc_y = $i;					
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
		$map_temp = $map_arr;
		
		$this->approach_for_water($plane_loc_x, $plane_loc_y, $diff_plane_water_x, $diff_plane_water_y,
								  $map_arr, $moves);
		$this->approach_for_fire($water_loc_x, $water_loc_y, $diff_water_fire_x, $diff_water_fire_y,
								  $map_arr, $moves);
		$map_result = array();
		for ($i=0;$i < $width;$i++) {
			$map_result[$i] = implode("", $map_temp[$i]);
		}
		$all = array("map" => $map_result, "moves" => $moves);
        return response()->json($all);
	}
}