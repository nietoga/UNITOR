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

Auth::routes();

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/period/index', 'PeriodController@index')->name('period.index');
Route::get('/period/new', 'PeriodController@new')->name('period.new');
Route::get('/period/{id}', 'PeriodController@show')->name('period.show');
Route::post('period/save', 'PeriodController@save')->name('period.save');
Route::post('/period/{id}', 'PeriodController@delete')->name('period.delete');
