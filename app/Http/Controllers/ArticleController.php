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
 
        #$article  = Article::find($id);
        $id = $req->input('number');
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
            /*
            $decom = array();
            $temp = $id;
            while($temp >= 2) {
                $temp = $temp/2;
                #$decom[] = 2;
                array_push($decom, 2);
            }*/
            $data = array("number" => $tem, "decomposition" => $decom);
        }
 
        return response()->json($data);
    }
 
}
