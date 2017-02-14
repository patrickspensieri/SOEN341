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

//get all available courses
Route::get('/allcourses', 'CourseController@index');




//groups all routes requiring authentication
Route::group(['middleware' => 'auth'], function () {
    //GET courses user is enrolled in
    Route::get('/courses', 'EnrollmentController@index');

    //GET view for enrolling in new courses
    Route::get('/courses/enroll', 'EnrollmentController@create');
    
    //POST enroll courses
    Route::post('/courses', 'EnrollmentController@store');
    
    //DELETE drop courses
    Route::delete('/courses', 'EnrollmentController@destroy');
    
});

/*
GET /courses (get all enrolled courses by authenticated user)

GET /courses/create (get the enrollment form )

POST /courses (store a new post)

GET /courses/{id}/edit (edit an exisiting enrollment)

GET /courses/{id} (show a particular enrolled course)

PATCH /courses/{id} (edit an enrollment)

DELETE /courses/{id} (delete an enrollment)
*/