<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {

    Route::get('/', function () {
        return view('welcome');
    })->middleware('guest');

    // Route - home
    Route::get('/home', function () {
        return redirect('/tasks');
    });
    
    // Route - tasks
    //Route::get('/home', 'HomeController@index');
    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');
    
    // Route - photo
    Route::resource('photo', 'PhotoController');
    
    // Route - test
    Route::get('/test/job', 'TestController@job');
    Route::get('/test/mail_from_template', 'TestController@mail_from_template');
    Route::get('/test/mailgun', 'TestController@mailgun');
    Route::get('/test/db', 'TestController@db');
    Route::get('/test/encrypt', 'TestController@encrypt');//addtask
    Route::get('/test/addtask/{task}', 'TestController@addtask');
    
    // Route - auth
    Route::auth();

});
