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
        $decom = array();
        $temp = $id;
        while($temp >= 2) {
            $temp = $temp/2;
            #$decom[] = 2;
            array_push($decom, 2);
        }
        $data = array("number" => $id, "decomposition" => $decom);
 
        return response()->json($data);
    }
 
}
