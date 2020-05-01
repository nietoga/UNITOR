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

// Home
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/forum', 'HomeController@forum')->name('forum');

// Localization
Route::get('/lang/{locale}', 'HomeController@lang');

// User routes
Route::get('/user/show/{id}', 'UserController@show')->name('user.show');
Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
Route::post('/user/update/{id}', 'UserController@update')->name('user.update');
Route::get('/user/edit_pp/{id}', 'UserController@editProfilePhoto')->name('user.edit_pp');
Route::post('/user/upload', 'UserController@upload')->name('user.upload');

// Period routes
Route::get('/period/index', 'PeriodController@index')->name('period.index');
Route::get('/period/new', 'PeriodController@new')->name('period.new');
Route::get('/period/show/{id}', 'PeriodController@show')->name('period.show');
Route::get('/period/edit/{id}', 'PeriodController@edit')->name('period.edit');
Route::post('/period/save', 'PeriodController@save')->name('period.save');
Route::patch('/period/update/{id}', 'PeriodController@update')->name('period.update');
Route::delete('/period/delete/{id}', 'PeriodController@delete')->name('period.delete');

// Course routes
Route::get('/course/new', 'CourseController@new')->name('course.new');
Route::get('/course/show/{id}', 'CourseController@show')->name('course.show');
Route::get('/course/edit/{id}', 'CourseController@edit')->name('course.edit');
Route::post('/course/save', 'CourseController@save')->name('course.save');
Route::patch('/course/update/{id}', 'CourseController@update')->name('course.update');
Route::delete('/course/delete/{id}', 'CourseController@delete')->name('course.delete');

//Activity routes
Route::get('/activity/new', 'ActivityController@new')->name('activity.new');
Route::get('/activity/show/{id}', 'ActivityController@show')->name('activity.show');
Route::get('/activity/edit/{id}', 'ActivityController@edit')->name('activity.edit');
Route::post('/activity/save', 'ActivityController@save')->name('activity.save');
Route::patch('/activity/update/{id}', 'ActivityController@update')->name('activity.update');
Route::delete('/activity/delete/{id}', 'ActivityController@delete')->name('activity.delete');

// Forum routes
Route::get('/post/index', 'PostController@index')->name('post.index');
Route::get('/post/new', 'PostController@new')->name('post.new');
Route::get('/post/show/{id}', 'PostController@show')->name('post.show');
Route::post('/post/save', 'PostController@save')->name('post.save');
Route::delete('/post/delete/{id}', 'PostController@delete')->name('post.delete');
Route::post('/post/edit/{id}', 'PostController@edit')->name('post.edit');
Route::patch('/post/update/{id}', 'PostController@update')->name('post.update');
Route::get('/post/{post_id}/fix_comment/{comment_id}', 'PostController@fix')->name('post.fix');

// Comments routes
Route::post('/comment/save', 'CommentController@save')->name('comment.save');
Route::delete('/comment/delete/{id}', 'CommentController@delete')->name('comment.delete');
Route::post('/commment/edit/{id}', 'CommentController@edit')->name('comment.edit');
Route::patch('/comment/update/{id}', 'CommentController@update')->name('comment.update');
Route::get('/comment/{id}/vote-up', 'CommentController@voteUp')->name('comment.voteUp');
Route::get('/comment/{id}/vote-down', 'CommentController@voteDown')->name('comment.voteDown');
Route::post('/commment/report/{id}', 'CommentController@report')->name('comment.report');

// Admin routes
Route::get('/admin', 'AdminController@index');
Route::get('/admin/index', 'AdminController@index')->name('admin.index');
