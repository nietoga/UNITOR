<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the 'web' middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/forum', 'HomeController@forum')->name('forum');

Route::get('/period/index', 'PeriodController@index')->name('period.index');
Route::get('/period/new', 'PeriodController@new')->name('period.new');
Route::get('/period/{id}', 'PeriodController@show')->name('period.show');
Route::post('period/save', 'PeriodController@save')->name('period.save');
Route::delete('/period/{id}', 'PeriodController@delete')->name('period.delete');

// Forum routes
Route::get('/post/index', 'PostController@index')->name('post.index');
Route::get('/post/new', 'PostController@new')->name('post.new');
Route::get('/post/show/{id}', 'PostController@show')->name('post.show');
Route::post('/post/save', 'PostController@save')->name('post.save');
Route::delete('/post/delete/{id}', 'PostController@delete')->name('post.delete');
Route::post('/post/edit/{id}', 'PostController@edit')->name('post.edit');
Route::patch('/post/update/{id}', 'PostController@update')->name('post.update');

// Comments routes
Route::post('/comment/save/{post_id}', 'CommentController@save')->name('comment.save');
Route::delete('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
Route::post('/commment/edit/{id}', 'CommentController@edit')->name('comment.edit');
Route::patch('/comment/update/{id}', 'CommentController@update')->name('comment.update');
?>
