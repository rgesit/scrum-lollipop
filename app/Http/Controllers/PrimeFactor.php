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

    private function formFactor($id) {
        if($id > 1000000) {
            return 'too big number (>1e6)';
        } elseif(!is_numeric($id)) {
            return $id.' is not a number';
        } elseif($id<=1) {
            return $id.' is not an integer > 1';
        } else {
            $json = $this->primeFactor($id);
            $jdata = implode(" x ", $json['decomposition']);
            return $id.' = '.$jdata;
        }
    }

    private function romanToInteger($roman) {
        $romans = array(
        'M' => 1000,
        'CM' => 900,
        'D' => 500,
        'CD' => 400,
        'C' => 100,
        'XC' => 90,
        'L' => 50,
        'XL' => 40,
        'X' => 10,
        'IX' => 9,
        'V' => 5,
        'IV' => 4,
        'I' => 1);

        #$roman = 'MMMCMXCIX';
        $result = 0;

        foreach ($romans as $key => $value) {
            while (strpos($roman, $key) === 0) {
                $result += $value;
                $roman = substr($roman, strlen($key));
            }
        }
        return $result;
    }

    private function integerToRoman($integer, $upcase = true) { 
        $table = array('M'=>1000, 'CM'=>900, 'D'=>500, 'CD'=>400, 'C'=>100, 'XC'=>90, 'L'=>50, 'XL'=>40, 'X'=>10, 'IX'=>9, 'V'=>5, 'IV'=>4, 'I'=>1); 
        $return = ''; 
        while($integer > 0) 
        { 
            foreach($table as $rom=>$arb) 
            { 
                if($integer >= $arb) 
                { 
                    $integer -= $arb; 
                    $return .= $rom; 
                    break; 
                } 
            } 
        } 

        return $return; 
    } 
 
    public function factor(Request $req){
	
		$data = array();
        $query = explode('&', @$_SERVER['QUERY_STRING']);
        $params = array();
        if(count($query) > 1) {
            foreach( $query as $param ) {
                list($name, $value) = explode('=', $param, 2);
                $params[urldecode($name)][] = urldecode($value);
            }
        } else {
            $params['number'] = $req->input('number');
        }
        if(isset($_SERVER['HTTP_REFERER']) and $_SERVER['HTTP_REFERER'] == "http://".$_SERVER['HTTP_HOST']."/primeFactors/ui") {
            #echo'<pre>';print_r($_SERVER);echo'</pre>'; die();
            $id = $req->input('number');

            #$delimiter = array(", ", ":", ";", "*", "%", "\n", " ");
            $numdata = explode(", ", $id);

            if(count($numdata) > 1) {
                $output = '<div id="result"></div>';
                $output .= '<ol id="results">';
                foreach ($numdata as $value) {
                    $decom = $this->formFactor($value);
                    $output .= '<li>'.$decom.'</li>';
                }
                $output .= '</ol>';
                echo $output; die();

            } else {
                $file = "/data/project/lollipop/last.txt";
                $last = str_replace("result", "last-decomposition", file_get_contents($file));
                echo $last;
                if($id > 1000000) {
                    $output =  '<div id="result">too big number (>1e6)</div>'; 
                    echo $output;
                    #die();
                } elseif(!is_numeric($id)) {
                    $output = '<div id="result">'.$id.' is not a number</div>'; 
                    echo $output;
                    #die();
                } elseif($id<=1) {
                    $output = '<div id="result">'.$id.' is not an integer > 1</div>'; 
                    echo $output;
                    #die();
                } else {
                    $json = $this->primeFactor($id);
                    $jdata = implode(" x ", $json['decomposition']);
                    $output = '<div id="result">'.$id.' = '.$jdata.'</div>'; 
                    echo $output;
                    #die();
                }
                $file = "/data/project/lollipop/last.txt";
                $fp = @fopen($file, "w+");
                    if($fp){
                    @fwrite($fp, $output);
                    #echo "overwrite to : ".$file."<br>\n";
                    @fclose($fp);
                    @chmod($fileXML, 0775);
                }
                die();
            }

        } elseif(count($params['number']) > 1) {
	        foreach($params['number'] as $num) {
		        $datatemp = $this->primeFactor($num);
		        array_push($data, $datatemp);
	        }
        } elseif(ctype_upper($req->input('number'))) {
            $id = $req->input('number');
            $integernumber = $this->romanToInteger($id);
            $data = $this->primeFactor($integernumber);
            $data['number'] = $this->integerToRoman($data['number']);
            foreach ($data['decomposition'] as $key => $value) {
                $data['decomposition'][$key] = $this->integerToRoman($value);
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
 
    public function formPrimer(){
    
        return view('primerform');

    }
 
}
