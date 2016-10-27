<?php
/*
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



    $router->group([] , function () use ($router) {

        require(__DIR__ . '/Routes/Organisation/organisation.php');
    });

    $router->group([] , function () use ($router) {

        require(__DIR__ . '/Routes/Access/access.php');
    });
    $router->group([] , function () use ($router) {

        require(__DIR__ . '/Routes/Administrator/administrator.php');
    });

    $router->group([] , function () use ($router) {

        require(__DIR__ . '/Routes/Area/area.php');
    });
    $router->group([] , function () use ($router) {

        require(__DIR__ . '/Routes/LineOffice/lineOffice.php');
    });
    $router->group([] , function () use ($router) {

        require(__DIR__ . '/Routes/Sector/sector.php');
    });
    $router->group([] , function () use ($router) {

        require(__DIR__ . '/Routes/WorkingZone/workingZone.php');
    });
    $router->group([] , function () use ($router) {

        require(__DIR__ . '/Routes/Project/project.php');
    });



    /**** other features pages ****************/

    Route::get('/report' , ['middleware' => 'auth' , 'as' => 'getReport' , 'uses' => 'AppController@getReport']);

    Route::get('/export-project' , ['middleware' => 'auth' , 'as' => 'exportProject' , 'uses' => 'AppController@exportProject']);


    Route::post('/projects/getWorkingZone/{id}' ,  'ProjectController@getWorkingZone');
    Route::get('/about' , 'AppController@about');
    Route::get('/logout' , 'UserController@logout');


