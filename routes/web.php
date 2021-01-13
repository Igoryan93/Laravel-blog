<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('index');


Route::group(['middleware' => 'guest'], function() {
    Route::get('/in', 'AuthController@login')->name('in');
    Route::post('/in', 'AuthController@in');

    Route::get('/reg', 'RegController@register')->name('reg');
    Route::post('/reg', 'RegController@create');

});