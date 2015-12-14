<?php
 
namespace App\Http\Controllers;
 
use App\Article;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
 
 
class ArticleController extends Controller{
 
 
    public function index(){
 
        $articles  = Article::all();
 
        return response()->json($articles);
 
    }
 
    public function getArticle($id){
 
        $article  = Article::find($id);
 
        return response()->json($article);
    }
 
    public function saveArticle(Request $request){
 
        $article = Article::create($request->all());
 
        return response()->json($article);
 
    }
 
    public function deleteArticle($id){
        $article  = Article::find($id);
 
        $article->delete();
 
        return response()->json('success');
    }
 
    public function updateArticle(Request $request,$id){
        $article  = Article::find($id);
 
        $article->title = $request->input('title');
        $article->content = $request->input('content');
 
        $article->save();
 
        return response()->json($article);
    }
 
    public function primeFactors(Request $req){
 
        $data2 = array();
        #$article  = Article::find($id);
        $query = explode('&', $_SERVER['QUERY_STRING']);
        $params = array();
        foreach( $query as $param ) {
            list($name, $value) = explode('=', $param, 2);
            $params[urldecode($name)][] = urldecode($value);
        } #print_r($params['number']); die();
        //$id = $req->input('number');
        
        foreach($params['number'] as $id) {
            $tem = $id;
            if(!is_numeric($tem)) {
                $data = array("number" => $tem, "error" => "not a number");
            } elseif($tem > 1000000) {
                $data = array("number" => $tem, "error" => "too big number (>1e6)");
            } else {
                $i = 2;
                $decom = array();
                while($i * $i <= $tem) {
                    if($tem % $i) {
                        $i += 1;
                    } else {
                        $tem = $tem / $i;
                        array_push($decom, $i);
                    }
                }
                if($tem > 1) {
                    array_push($decom, $tem);
                }
                /*
                $decom = array();
                $temp = $id;
                while($temp >= 2) {
                    $temp = $temp/2;
                    #$decom[] = 2;
                    array_push($decom, 2);
                }*/
                $data = array("number" => $id, "decomposition" => $decom);
            }
            array_push($data2, $data);
        }
 
        return response()->json($data2);
    }
 
}
