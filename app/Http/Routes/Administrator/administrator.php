<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 8/16/16
     * Time: 1:29 PM
     */

    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['auth']], function () {
        /* Administrator Routes */
        Route::get('/administrator/' , ['as' => 'getAdminstratorDashboard' , 'uses' => 'UserController@getAdminstratorDashboard']);
        Route::get('/administrator/user' , ['as' => 'getUser' , 'uses' => 'UserController@getUser']);
        Route::get('/administrator/user/create' , ['as' => 'createUser' , 'uses' => 'UserController@createUser']);
        Route::post('/administrator/user/store' , ['as' => 'storeUser' , 'uses' => 'UserController@storeUser']);
        Route::get('/administrator/user/edit/{id}' , ['as' => 'editUser' , 'uses' => 'UserController@editUser']);
        Route::post('/administrator/user/update/{id}' , ['as' => 'updateUser' , 'uses' => 'UserController@updateUser']);
        Route::get('/administrator/user/delete/{id}' , ['as' => 'deleteUser' , 'uses' => 'UserController@deleteUser']);
        Route::get('/administrator/organization' , ['as' => 'getOrgs' , 'uses' => 'UserController@getOrgs']);
        Route::get('/administrator/organization/view/{id}' , ['as' => 'getOrgDetail' , 'uses' => 'UserController@getOrgDetail']);
        Route::get('/administrator/project' , ['as' => 'getProjs' , 'uses' => 'UserController@getProjs']);
        Route::get('/administrator/project/view/{id}' , ['as' => 'getProjectDetail' , 'uses' => 'UserController@getProjectDetail']);
        Route::get('/administrator/projectByDistrict/{id}' , ['uses' => 'UserController@getProjectByDistrict']);
        Route::get('/administrator/projectSearch' , ['uses' => 'UserController@getProjectAdministrator']);
        Route::get('exportData', ['as' =>'exportData','uses' => 'UserController@export']);
    }); 