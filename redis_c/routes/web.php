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

Route::get('/', function () {

    /*
    $userStat3 = [
        'favourites' => 10,
        'watchLaters' => 5,
        'completions' => 6,
    ];
    Redis::hmset('user.1.stats', $userStat3); */

//    \Illuminate\Support\Facades\Cache::put('foo2', 'bar2', 10);
//
//    return \Illuminate\Support\Facades\Cache::get('foo2');



    //return Cache::store('redis');
    Cache::put('bar3', 'baz32');
    $val = Cache::get('bar3');


    return $val;

    //return Redis::hgetall('user.1.stats');
});

Route::get('/user/{id}/stats', function ($id) {
    return Redis::hgetall("user.{$id}.stats");
});


Route::get('favourite-video', function () {
    Redis::hincrby('user.1.stats', 'favourites', 1);
    return redirect('/');
});


Route::get('articles/trending', function () {

    $trending = Redis::zrevrange('trending_articles', 0, 2);

    $trending = \App\Models\Article::hydrate(
      array_map('json_decode', $trending)
    );

    //\App\Models\Article::hydrateFromJsonString($trending );

    return $trending;
});



Route::get('articles/{article}', function (\App\Models\Article $article) {
    Redis::zincrby('trending_articles', 1 , $article->toJson());

    //Redis::zremrangebyrank('trending_articles', 0, -4);
    return $article;
});
