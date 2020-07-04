<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/


/**
 * PRODUCTION
 */


// LOGIN
Route::post('/auth/login', 'AuthController@authenticate');
Route::post('/auth/register', 'AuthController@register');


// VIEW
Route::get('/', 'view\ViewController@login');
Route::get('/register', 'view\ViewController@register');


$router->group(['prefix' => 'api', 'middleware' => 'jwt.auth'], function () {



    Route::get('/{db}/all/{table}', 'GeneralController@all');
    Route::get('/{db}/field/{table}/', 'GeneralController@field');
    Route::get('/{db}/filters/{table}/{field}/{condition}', 'GeneralController@filter');
    Route::get('/{db}/filter/{table}/', 'GeneralController@filter');

    Route::post('/{db}/select', 'GeneralController@select');
    Route::post('/{db}/upload', 'GeneralController@upload');
    Route::post('/{db}/uploadInsert', 'GeneralController@uploadInsert');


    Route::post('/{db}/create/', 'GeneralController@create');
    Route::post('/{db}/createAutoincrement/', 'GeneralController@create_autoincrement');


    Route::put('/{db}/edit/', 'GeneralController@edit');
    Route::post('/{db}/destroy/', 'GeneralController@destroy');
    Route::delete('/{db}/destroy/{table}/{field}/{id}', 'GeneralController@delete');

    Route::post('/auth/register', 'AuthController@register');

    Route::get('/informacion', 'view\ViewController@informacion');

    Route::get('/salir', 'view\ViewController@salir');



});


/**
 * DEVELOPMENT
 */

if (app()->environment('local')) {

    $router->group(['prefix' => 'unsafe'], function () {
        Route::get('/{db}/all/{table}', 'GeneralController@all');
        Route::get('/{db}/field/{table}/', 'GeneralController@field');
        Route::get('/{db}/filters/{table}/{field}/{condition}', 'GeneralController@filter');
        Route::get('/{db}/filter/{table}/', 'GeneralController@filter');

        Route::post('/{db}/select', 'GeneralController@select');
        Route::post('/{db}/upload', 'GeneralController@upload');
        Route::post('/{db}/uploadInsert', 'GeneralController@uploadInsert');


        Route::post('/{db}/create/', 'GeneralController@create');
        Route::post('/{db}/createAutoincrement/', 'GeneralController@create_autoincrement');

        Route::put('/{db}/edit/', 'GeneralController@edit');
        Route::post('/{db}/destroy/', 'GeneralController@destroy');




    });


    /**
     * TESTING
     */


    $router->get('/version', function () use ($router) {
        return $router->app->version();
    });









}
