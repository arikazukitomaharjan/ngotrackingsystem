<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 8/16/16
     * Time: 1:35 PM
     */

    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['auth']] , function () {

        /* manage Line Office */
        Route::get('/line-offices' , ['as' => 'getLineOffices' , 'uses' => 'LineOfficeController@index']);
        Route::get('/line-offices/create' , ['as' => 'createLineOffice' , 'uses' => 'LineOfficeController@create']);
        Route::post('/line-offices/store' , ['as' => 'storeLineOffice' , 'uses' => 'LineOfficeController@store']);
        Route::get('/line-offices/edit/{id}' , ['as' => 'editLineOffice' , 'uses' => 'LineOfficeController@edit']);
        Route::post('/line-offices/update/{id}' , ['as' => 'updateLineOffice' , 'uses' => 'LineOfficeController@update']);
        Route::get('/line-offices/delete/{id}' , ['as' => 'deleteLineOffice' , 'uses' => 'LineOfficeController@destroy']);

        //Show
        Route::get('/line-offices/{id}' , ['middleware' => 'auth' , 'as' => 'getProjectsByLO' , 'uses' => 'LineOfficeController@show']);
    });