<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 8/16/16
     * Time: 1:34 PM
     */
    use Illuminate\Support\Facades\Route;
    
    Route::group(['middleware' => ['auth']], function () {
        /* manage Sector */
        Route::get('/sectors' , ['as' => 'getSectors' , 'uses' => 'SectorController@index']);
        Route::get('/sectors/budget' , ['as' => 'getSectorsBudget' , 'uses' => 'SectorController@getSectorsBudget']);
        Route::get('/sectors/create' , ['as' => 'createSector' , 'uses' => 'SectorController@create']);
        Route::post('/sectors/store' , ['as' => 'storeSector' , 'uses' => 'SectorController@store']);
        Route::get('/sectors/edit/{id}' , ['as' => 'editSector' , 'uses' => 'SectorController@edit']);
        Route::post('/sectors/update/{id}' , ['as' => 'updateSector' , 'uses' => 'SectorController@update']);
        Route::get('/sectors/delete/{id}' , ['as' => 'deleteSector' , 'uses' => 'SectorController@destroy']);


        //Show
        Route::get('/sectors/{id}' , ['as' => 'getProjectsBySector' , 'uses' => 'SectorController@show']);
    });