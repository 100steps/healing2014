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
	// return View::make('index');
	return;
});

// 授权
Route::get('healing2014/auth/{code}', 'HealingController@auth');
// 点歌
Route::get('healing2014', 'HealingController@index');
Route::post('healing2014', 'HealingController@save');
// 治愈成功
Route::get('healing2014/success', 'HealingController@success');
// 歌单列表
Route::get('healing2014/list' , 'SonglistController@showSonglist');
// 投票
Route::get('healing2014/vote' , 'HealingController@vote');
// 治愈成功
Route::get('healing2014/22bookshop', 'HealingController@show22bookshop');


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