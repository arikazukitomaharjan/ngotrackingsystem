<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 8/16/16
     * Time: 1:35 PM
     */
    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['auth']] , function () {

        /* manage Area */
        Route::get('/areas' , ['as' => 'getAreas' , 'uses' => 'AreaController@index']);
        Route::get('/areas/create' , ['as' => 'createArea' , 'uses' => 'AreaController@create']);
        Route::post('/areas/store' , ['as' => 'storeArea' , 'uses' => 'AreaController@store']);
        Route::get('/areas/edit/{id}' , ['as' => 'editArea' , 'uses' => 'AreaController@edit']);
        Route::post('/areas/update/{id}' , ['as' => 'updateArea' , 'uses' => 'AreaController@update']);
        Route::get('/areas/delete/{id}' , ['as' => 'deleteArea' , 'uses' => 'AreaController@destroy']);

        //Show
        Route::get('/areas/{id}' , ['as' => 'getProjectsByArea' , 'uses' => 'SectorController@showByArea']);
    });
