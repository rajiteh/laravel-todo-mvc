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

Route::group([
    'middleware' => 'auth',
    'namespace' => 'API',
    'prefix' => 'api',
], function() {

    Route::group([
        'namespace' => 'v1',
        'prefix' => 'v1'
    ], function() {
        Route::resource('checklists', 'CheckListsAPIController', [
            'except' => [
                'edit'
            ]
        ]);
        Route::resource('checklists.tasks', 'TasksAPIController', [
            'except' => [
                'edit'
            ]
        ]);
    });

});

Route::get('/', [ 'as' => 'ho', 'uses' => 'HomePageController@show' ]);


// Authentication routes...
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');
