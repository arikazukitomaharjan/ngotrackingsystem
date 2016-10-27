<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 8/16/16
     * Time: 1:34 PM
     */

    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['auth']], function () {
        /* manage Working Zone */
        Route::get('/working-zones' , ['as' => 'getWorkingZones' , 'uses' => 'WorkingZoneController@index']);
        Route::get('/working-zones/budget' , ['as' => 'getWorkingZonesBudget' , 'uses' => 'WorkingZoneController@getWorkingZonesBudget']);
        Route::get('/working-zones/create' , ['as' => 'createWorkingZone' , 'uses' => 'WorkingZoneController@create']);
        Route::post('/working-zones/store' , ['as' => 'storeWorkingZone' , 'uses' => 'WorkingZoneController@store']);
        Route::get('/working-zones/edit/{id}' , ['as' => 'editWorkingZone' , 'uses' => 'WorkingZoneController@edit']);
        Route::post('/working-zones/update/{id}' , ['as' => 'updateWorkingZone' , 'uses' => 'WorkingZoneController@update']);
        Route::get('/working-zones/delete/{id}' , ['as' => 'deleteWorkingZone' , 'uses' => 'WorkingZoneController@destroy']);


        //Show
        Route::get('/working-zones/{id}' , ['as' => 'getProjectsByWZ' , 'uses' => 'WorkingZoneController@show']);
    });