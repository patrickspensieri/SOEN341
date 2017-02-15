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

Route::get('/', function () {
    //return view('landing');
    return view('landing');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

//GET all available courses
Route::get('/allcourses', 'CourseController@index');

//groups all routes requiring authentication
Route::group(['middleware' => 'auth'], function () {

    //GET view for enrolling in new courses
    Route::get('/courses', 'EnrollmentController@create');
    
    //POST enroll courses
    Route::post('/courses', 'EnrollmentController@store');    
});

//Facebook routes
Route::get('auth/facebook', 'FacebookController@facebookRedirect')->name('facebook.login');
Route::get('auth/facebook/callback', 'FacebookController@facebookCallback');