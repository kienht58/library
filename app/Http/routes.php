<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::group(['middleware' => ['web']], function () {
    Route::get('/', [
        'as' => 'home',
        'uses' => 'HomeController@index'
    ]);

    Route::get('api/books', [
        'as' => 'api.index',
        'uses' => 'ApiController@index'
    ]);

    Route::get('api/books/show', [
        'as' => 'api.show',
        'uses' => 'ApiController@show'
    ]);

    Route::post('api/books/create', [
        'as' => 'api.create',
        'uses' => 'ApiController@create'
    ]);

    Route::post('api/books/edit', [
        'as' => 'api.edit',
        'uses' => 'ApiController@edit'
    ]);

    Route::delete('api/books/delete', [
        'as' => 'api.delete',
        'uses' => 'ApiController@destroy'
    ]);
    
    Route::auth();
});
