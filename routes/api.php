<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/courses', 'Api\CourseApi@index')->name("api.course.index");
Route::get('/courses/{id}', 'Api\CourseApi@show')->name("api.course.show");
Route::get('/v2/courses', 'Api\CourseApiV2@index')->name("api.v2.course.index");
Route::get('/v2/courses/{id}', 'Api\CourseApiV2@show')->name("api.v2.course.show");
