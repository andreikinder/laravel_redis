<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Redis;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



 class Articles {
     public function all(){
         return Cache::remember('articles.all', 60*60, function (){
             return \App\Models\Article::all();
         });

     }
 }

Route::get('/', function (Articles $articles) {

 return $articles->all();
});
