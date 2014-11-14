<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('webroot_index');
});

// 授权
Route::get('healing2014/auth/{code}', 'HealingController@auth');
Route::get('healing2014/auth2/{code}', 'HealingController@auth2');
// 点歌
Route::get('healing2014', 'HealingController@index');
Route::post('healing2014', 'HealingController@save');
// 治愈成功
Route::get('healing2014/success', 'HealingController@success');
// 歌单列表
Route::get('healing2014/list' , 'SonglistController@showSonglist');
// 投票
Route::get('healing2014/vote' , 'VoteController@showList');
// 广告
Route::get('healing2014/22bookshop', 'HealingController@show22bookshop');
// 社区
Route::get('healing2014/wsq' , function(){
	// echo '<h1>活动即将开始,敬请期待~</h1>';
	return Redirect::to('http://m.wsq.qq.com/263552171');
});


// 后台编辑界面
Route::get('healing2014/admin/edit' , 'AdminController@edit');
Route::post('healing2014/admin/edit' , 'AdminController@update');
// 后台生成歌单
Route::get('healing2014/admin/build' , 'AdminController@build');
Route::post('healing2014/admin/create' , 'AdminController@create');
// 后台输出excel表格
Route::get('healing2014/admin/export' , 'AdminController@export');


// 生成歌单PNG
Route::get('healing2014/gen/songlist/{pageId}' , 'SonglistController@createSonglistPNG_v2');
Route::get('healing2014/gen/json/{pageId}' , 'SonglistController@getSongJSON');
Route::get('healing2014/gen/favourite' , 'SonglistController@getFavouriteSongJSON');

//搜索
Route::get('healing2014/gen/keyword/{keyword}' , 'SearchController@searchKeyword');
Route::get('healing2014/gen/songlist/keyword/{keyword}/{pageId}' , 'SearchController@createSonglistPNG');
Route::get('healing2014/gen/json/keyword/{keyword}/{pageId}' , 'SearchController@getSongJSON');


// 歌单列表
Route::get('healing2014/test/list' , 'SonglistController@showSonglist_test');
Route::get('healing2014/test/vote' , 'VoteController@showList_test');
Route::get('healing2014/test/vote/detail/{id}' , 'VoteController@showDetailPage');