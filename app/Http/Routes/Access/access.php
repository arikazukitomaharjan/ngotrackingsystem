<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 8/16/16
     * Time: 1:16 PM
     */

    use Illuminate\Support\Facades\Route;

    Route::group([] , function () {

        Route::get('/switch-lang/{slug}' , ['as' => 'switchLang' , 'uses' => 'AppController@switchLang']);

        Route::get('/' , ['as' => 'getLogin' , 'uses' => 'UserController@getLogin']);
        Route::get('/login' , ['as' => 'getLogin' , 'uses' => 'UserController@getLogin']);
        Route::post('/login' , ['as' => 'postLogin' , 'uses' => 'UserController@postLogin']);
        Route::get('/auth/login' , ['as' => 'getLogin' , 'uses' => 'UserController@getLogin']);

    });

    Route::group(['middleware' => ['auth']] , function () {

        Route::get('/dashboard' , ['as' => 'getDashboard' , 'uses' => 'AppController@getDashboard']);
    });