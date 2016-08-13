<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::get('/', function () {
        return view('index');
    })->middleware('guest');



    /*// Task Routes
    Route::get('/tasks', 'TaskController@index');
    Route::post('/task', 'TaskController@store');
    Route::delete('/task/{task}', 'TaskController@destroy');*/

    // Pages Routes

    Route::get('/pages', 'PageController@index');
    Route::post('/page', 'PageController@store');
    Route::get('/page/{page}/edit', 'PageController@edit');
    Route::put('/page/{page}/update', 'PageController@update');
    Route::delete('/page/{page}', 'PageController@destroy');


    // Subject Routes

    Route::get('/subjects', 'SubjectController@index');
    Route::post('/subject', 'SubjectController@store');
    Route::delete('/subject/{subject}', 'SubjectController@destroy');
    Route::get('/subject/{subject}/edit', 'SubjectController@edit');
    Route::put('/subject/{subject}/update', 'SubjectController@update');

    // Authentication Routes...
    Route::auth();

    //JWT Authentication API Routes...

    /*Route::group(['prefix' => 'api'], function()
    {
        Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
        Route::post('authenticate', 'AuthenticateController@authenticate');
    });*/




    //AngularJS Routes
    Route::group(['prefix' => 'api'], function()
    {
        Route::post('authenticate', 'AuthenticateController@authenticate');
        Route::get('authenticate/user', 'AuthenticateController@getAuthenticatedUser');
        Route::group(['middleware' => 'jwt.auth'], function()
        {
            //Subjects
            Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
            Route::get('/subjects', 'SubjectController@index');
            Route::post('/subject', 'SubjectController@store');
            Route::delete('/subject/{subject}', 'SubjectController@destroy');
            Route::get('/subject/{subject}/edit', 'SubjectController@edit');
            Route::put('/subject/{subject}/update', 'SubjectController@update');
            //Pages
            Route::get('/pages', 'PageController@index');
            Route::post('/page', 'PageController@store');
            Route::get('/page/{page}/edit', 'PageController@edit');
            Route::put('/page/{page}/update', 'PageController@update');
            Route::delete('/page/{page}', 'PageController@destroy');
        });
    });



});
