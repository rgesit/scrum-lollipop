<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', 'Controller@index');
$app->get('/aboutme', 'Controller@aboutme');

$app->get('api/article','ArticleController@index');
 
$app->get('api/article/{id}','ArticleController@getArticle');
 
$app->post('api/article','ArticleController@saveArticle');
 
$app->put('api/article/{id}','ArticleController@updateArticle');
 
$app->delete('api/article/{id}','ArticleController@deleteArticle');

$app->get('primeFactors','PrimeFactor@factor');
$app->get('primeFactors/ui','PrimeFactor@form');
$app->get('primerFactors/ui','PrimeFactor@formPrimer');
$app->post('primeFactors/ui','PrimeFactor@factor');
$app->post('primerFactors/ui','PrimeFactor@factor');
 
$app->get('minesweeper', 'YoseController@minesweeper');

$app->get('/fire/geek', 'YoseController@fire');

$app->get('/ping', 'YoseController@ping');
$app->get('/astroport', 'YoseController@astroport');
$app->get('/astroport/{id}', 'YoseController@astroport');
