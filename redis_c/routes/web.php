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


class CachebleArticles
{
    protected $articles;

    public function __construct($articles)
    {
        $this->articles = $articles;
    }
    public function all(){
        return Cache::remember('articles.all', 60*60, function (){
            return $this->articles->all();
        });

    }

}


 class Articles
 {
     public function all(){
          return \App\Models\Article::all();
     }
 }

Route::get('/', function () {

 $articles = new CachebleArticles(new Articles);
 return $articles->all();
});
