<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 8/16/16
     * Time: 1:35 PM
     */

    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['auth']] , function () {

        Route::get('/projects' , ['as' => 'getProjects' , 'uses' => 'ProjectController@index']);
        Route::get('/projects/new' , ['as' => 'createProject' , 'uses' => 'ProjectController@create']);
        Route::get('/projects/{status}' , ['as' => 'getProjectsByStatus' , 'uses' => 'ProjectController@index']);
        Route::get('/projects/fiscal_year_bs/{year}' , ['uses' => 'ProjectController@fiscal_year_bs']);

        Route::get('/projects/view/{id}' , ['as' => 'getProjects' , 'uses' => 'ProjectController@show']);
        Route::post('/projects/store' , ['as' => 'storeProject' , 'uses' => 'ProjectController@store']);
        Route::get('/projects/edit/{id}' , ['as' => 'editProject' , 'uses' => 'ProjectController@edit']);
        Route::post('/projects/update/{id}' , ['as' => 'updateProject' , 'uses' => 'ProjectController@update']);
        Route::get('/projects/delete/{id}' , ['as' => 'deleteProject' , 'uses' => 'ProjectController@destroy']);
        Route::get('export', ['as' =>'export','uses' => 'ProjectController@export']);


    });
    