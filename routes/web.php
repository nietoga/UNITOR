<?php

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
Route::get('/', 'HomeController@index')->name("home.index");
Route::get('/forum', 'HomeController@forum')->name("home.forum");
Route::get('/post/show/{id}', 'PostController@show')->name("post.show");
Route::get('/post/create', 'PostController@create')->name("post.create");
Route::post('/post/save', 'PostController@save')->name("post.save");
Route::get('/post/list', 'PostController@list')->name("post.list");
Route::delete('/post/destroy/{id}', 'PostController@destroy')->name("post.destroy");
?>
