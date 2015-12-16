<?php
 
namespace App\Http\Controllers;
 
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
 
class PrimeFactor extends Controller{
    
    private function primeFactor($id) {
	    
	    	$data = array();
	    	$tem = $id;
	    	if(!is_numeric($id)) {
	            $data = array("number" => $id, "error" => "not a number");
	        } elseif($id > 1000000) {
	            $data = array("number" => $id, "error" => "too big number (>1e6)");
	        } else {
	            $i = 2;
	            $decom = array();
	            while($i * $i <= $id) {
	                if($id % $i) {
	                    $i += 1;
	                } else {
	                    $id = $id / $i;
	                    array_push($decom, $i);
	                }
	            }
	            if($id > 1) {
	                array_push($decom, $id);
	            }
	            $data = array("number" => $tem, "decomposition" => $decom);
	        }
	        return $data;
    }
 
    public function factor(Request $req){
	
		$data = array();
        $query = explode('&', $_SERVER['QUERY_STRING']);
        $params = array();
        foreach( $query as $param ) {
            list($name, $value) = explode('=', $param, 2);
            $params[urldecode($name)][] = urldecode($value);
        }
        if(isset($_SERVER['HTTP_REFERER']) and $_SERVER['HTTP_REFERER'] == "http://".$_SERVER['HTTP_HOST']."/primeFactors/ui") {
            #echo'<pre>';print_r($_SERVER);echo'</pre>'; die();
            $id = $req->input('number');
            if($id > 1000000) {
                echo '<div id="result">too big number (>1e6)</div>'; die();
            } elseif(!is_numeric($id)) {
                echo '<div id="result">'.$id.' is not a number</div>'; die();
            } elseif($id<=1) {
                echo '<div id="result">'.$id.' is not an integer > 1</div>'; die();
            } else {
                $json = $this->primeFactor($id);
                $jdata = implode(" x ", $json['decomposition']);
                echo '<div id="result">'.$id.' = '.$jdata.'</div>'; die();
            }
        } elseif(count($params['number']) > 1) {
	        foreach($params['number'] as $num) {
		        $datatemp = $this->primeFactor($num);
		        array_push($data, $datatemp);
	        }
        } else {
	        $id = $req->input('number');
	        $data = $this->primeFactor($id);
		}
        return response()->json($data);
    }
 
    public function form(){
    
        return view('primeform');

    }
 
}