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
Route::get( '/' , [ 'as' => 'getLogin' , 'uses' => 'UserController@getLogin'] );
Route::get( '/login' , [ 'as' => 'getLogin' , 'uses' => 'UserController@getLogin'] );
Route::post( '/login' , [ 'as' => 'postLogin' , 'uses' => 'UserController@postLogin'] );

Route::get( '/dashboard' , [ 'as' => 'getDashboard' , 'uses' => 'AppController@getDashboard'] );
/* manage Area */
Route::get( '/areas' , [ 'as' => 'getAreas' , 'uses' => 'AreaController@index'] );
Route::get( '/areas/create' , [ 'as' => 'createArea' , 'uses' => 'AreaController@create'] );
Route::post( '/areas/store' , [ 'as' => 'storeArea' , 'uses' => 'AreaController@store'] );
Route::get( '/areas/edit/{id}' , [ 'as' => 'editArea' , 'uses' => 'AreaController@edit'] );
Route::post( '/areas/update/{id}' , [ 'as' => 'updateArea' , 'uses' => 'AreaController@update'] );
Route::get( '/areas/delete/{id}' , [ 'as' => 'deleteArea' , 'uses' => 'AreaController@destroy'] );
/* manage Line Office */
Route::get( '/line-offices' , [ 'as' => 'getLineOffices' , 'uses' => 'LineOfficeController@index'] );
Route::get( '/line-offices/create' , [ 'as' => 'createLineOffice' , 'uses' => 'LineOfficeController@create'] );
Route::post( '/line-offices/store' , [ 'as' => 'storeLineOffice' , 'uses' => 'LineOfficeController@store'] );
Route::get( '/line-offices/edit/{id}' , [ 'as' => 'editLineOffice' , 'uses' => 'LineOfficeController@edit'] );
Route::post( '/line-offices/update/{id}' , [ 'as' => 'updateLineOffice' , 'uses' => 'LineOfficeController@update'] );
Route::get( '/line-offices/delete/{id}' , [ 'as' => 'deleteLineOffice' , 'uses' => 'LineOfficeController@destroy'] );
/* manage Sector */
Route::get( '/sectors' , [ 'as' => 'getSectors' , 'uses' => 'SectorController@index'] );
Route::get( '/sectors/create' , [ 'as' => 'createSector' , 'uses' => 'SectorController@create'] );
Route::post( '/sectors/store' , [ 'as' => 'storeSector' , 'uses' => 'SectorController@store'] );
Route::get( '/sectors/edit/{id}' , [ 'as' => 'editSector' , 'uses' => 'SectorController@edit'] );
Route::post( '/sectors/update/{id}' , [ 'as' => 'updateSector' , 'uses' => 'SectorController@update'] );
Route::get( '/sectors/delete/{id}' , [ 'as' => 'deleteSector' , 'uses' => 'SectorController@destroy'] );
/* manage Organization */
Route::get( '/organizations' , [ 'as' => 'getOrganizations' , 'uses' => 'OrganizationController@index'] );
Route::get( '/organizations/create' , [ 'as' => 'createOrganization' , 'uses' => 'OrganizationController@create'] );
Route::post( '/organizations/store' , [ 'as' => 'storeOrganization' , 'uses' => 'OrganizationController@store'] );
Route::get( '/organizations/edit/{id}' , [ 'as' => 'editOrganization' , 'uses' => 'OrganizationController@edit'] );
Route::post( '/organizations/update/{id}' , [ 'as' => 'updateOrganization' , 'uses' => 'OrganizationController@update'] );
Route::get( '/organizations/delete/{id}' , [ 'as' => 'deleteOrganization' , 'uses' => 'OrganizationController@destroy'] );
/* manage Working Zone */
Route::get( '/working-zones' , [ 'as' => 'getWorkingZones' , 'uses' => 'WorkingZoneController@index'] );
Route::get( '/working-zones/create' , [ 'as' => 'createWorkingZone' , 'uses' => 'WorkingZoneController@create'] );
Route::post( '/working-zones/store' , [ 'as' => 'storeWorkingZone' , 'uses' => 'WorkingZoneController@store'] );
Route::get( '/working-zones/edit/{id}' , [ 'as' => 'editWorkingZone' , 'uses' => 'WorkingZoneController@edit'] );
Route::post( '/working-zones/update/{id}' , [ 'as' => 'updateWorkingZone' , 'uses' => 'WorkingZoneController@update'] );
Route::get( '/working-zones/delete/{id}' , [ 'as' => 'deleteWorkingZone' , 'uses' => 'WorkingZoneController@destroy'] );

Route::get( '/projects' , [ 'as' => 'getProjects' , 'uses' => 'ProjectController@index'] );
Route::get( '/projects/new' , [ 'as' => 'createProject' , 'uses' => 'ProjectController@create'] );
Route::get( '/projects/{status}' , [ 'as' => 'getProjectsByStatus' , 'uses' => 'ProjectController@index'] );

Route::get( '/projects/view/{id}' , [ 'as' => 'getProjects' , 'uses' => 'ProjectController@show'] );
Route::post( '/projects/store' , [ 'as' => 'storeProject' , 'uses' => 'ProjectController@store'] );
Route::get( '/projects/edit/{id}' , [ 'as' => 'editProject' , 'uses' => 'ProjectController@edit'] );
Route::post( '/projects/update/{id}' , [ 'as' => 'updateProject' , 'uses' => 'ProjectController@update'] );
Route::get( '/projects/delete/{id}' , [ 'as' => 'deleteProject' , 'uses' => 'ProjectController@destroy'] );

Route::get( '/organizations/{id}' , [ 'as' => 'getProjectsByOrg' , 'uses' => 'OrganizationController@show'] );
Route::get( '/working-zones/{id}' , [ 'as' => 'getProjectsByWZ' , 'uses' => 'WorkingZoneController@show'] );
Route::get( '/sectors/{id}' , [ 'as' => 'getProjectsBySector' , 'uses' => 'SectorController@show'] );
Route::get( '/areas/{id}' , [ 'as' => 'getProjectsByArea' , 'uses' => 'SectorController@showByArea'] );
Route::get( '/line-offices/{id}' , [ 'as' => 'getProjectsByLO' , 'uses' => 'LineOfficeController@show'] );


Route::get('/logout', 'UserController@logout');

