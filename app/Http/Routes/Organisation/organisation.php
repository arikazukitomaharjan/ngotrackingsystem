<?php
    /**
     * Created by PhpStorm.
     * User: sabin
     * Date: 8/16/16
     * Time: 1:18 PM
     */
    use Illuminate\Support\Facades\Route;

    Route::group(['middleware' => ['auth']] , function () {

        Route::get('/organization/project/create' , ['as' => 'createOrgProject' , 'uses' => 'OrganizationController@createOrgProject']);
        Route::post('/organization/project/store' , ['as' => 'storeOrgProject' , 'uses' => 'OrganizationController@storeOrgProject']);
        Route::get('/organization/project/edit/{id}' , ['as' => 'editOrgProject' , 'uses' => 'OrganizationController@editOrgProject']);
        Route::post('/organization/project/update/{id}' , ['as' => 'updateOrgProject' , 'uses' => 'OrganizationController@updateOrgProject']);
        Route::get('/organization/project/{status}' , ['as' => 'getOrgProjectsStatus' , 'uses' => 'OrganizationController@getOrgProjects']);
        Route::get('/organization/project/view/{id}' , ['as' => 'viewOrgProject' , 'uses' => 'OrganizationController@viewOrgProject']);
        Route::get('/organization/project/delete/{id}' , ['as' => 'deleteOrgProject' , 'uses' => 'OrganizationController@deleteOrgProject']);
        Route::get('/organization/sector/{id}' , ['as' => 'getProjectBySector' , 'uses' => 'OrganizationController@getProjectBySector']);
        Route::get('/organization/area/{id}' , ['as' => 'getProjectByArea' , 'uses' => 'OrganizationController@getProjectByArea']);
        Route::get('/organization/working-zone/{id}' , ['as' => 'getProjectByWorkingZone' , 'uses' => 'OrganizationController@getProjectByWorkingZone']);
        Route::get('/organization/project' , ['as' => 'getOrgProjects' , 'uses' => 'OrganizationController@getOrgProjects']);
        Route::get('/organization/project/fiscal_year_bs/{year}' , ['uses' => 'OrganizationController@getOrgProjectsByFiscalYear']);
        Route::get('/organization/{slug}' , ['as' => 'getOrgDashboard' , 'uses' => 'OrganizationController@getOrgDashboard']);
        Route::get('/organization/about' , ['uses' => 'OrganizationController@getOrgAbout']);

        /* manage Organization */
        Route::get('/organizations' , ['as' => 'getOrganizations' , 'uses' => 'OrganizationController@index']);
        Route::get('/organizations/requests' , ['as' => 'getOrganizations' , 'uses' => 'OrganizationController@getRequests']);
        Route::get('/organizations/budget' , ['as' => 'getOrganizationsBudget' , 'uses' => 'OrganizationController@getOrganizationsBudget']);
        Route::get('/organizations/create' , ['as' => 'createOrganization' , 'uses' => 'OrganizationController@create']);
        Route::post('/organizations/store' , ['as' => 'storeOrganization' , 'uses' => 'OrganizationController@store']);
        Route::get('/organizations/edit/{id}' , ['as' => 'editOrganization' , 'uses' => 'OrganizationController@edit']);
        Route::post('/organizations/update/{id}' , ['as' => 'updateOrganization' , 'uses' => 'OrganizationController@update']);
        Route::get('/organizations/delete/{id}' , ['as' => 'deleteOrganization' , 'uses' => 'OrganizationController@destroy']);

        Route::get('/organizations/{id}' , ['as' => 'getProjectsByOrg' , 'uses' => 'OrganizationController@show']);

    });
    /* Organizat ion registration */
    Route::get('/registration/organization/' , ['as' => 'createOrganizationRegistration' , 'uses' => 'OrganizationController@createOrganizationRegistration']);
    Route::post('/registration/organization/' , ['as' => 'storeOrganizationRegistration' , 'uses' => 'OrganizationController@storeOrganizationRegistration']);



