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

Route::get('test', function () {
    return view('welcome');
});

Route::get('/', 'HomeController@index')->name('index');


Route::group(['middleware' => 'guest'], function() {
    Route::get('/in', 'HomeController@login')->name('in');
    Route::post('/in', 'AuthController@in');

    Route::get('/reg', 'HomeController@register')->name('reg');
    Route::post('/reg', 'RegController@create');

    Route::get('/verify/{token}', 'RegController@verify')->name('verify');
});

Route::group(['middleware' => 'auth'], function() {
    Route::get('/profile/{id}', 'HomeController@profile')->name('profile');

    Route::get('/edit/{id}', 'HomeController@edit')->name('edit');
    Route::post('/edit/{id}', 'UserController@edit');

    Route::get('/security/{id}', 'HomeController@security')->name('security');
    Route::post('/security/{id}', 'UserController@security');

    Route::get('/status/{id}', 'HomeController@status')->name('status');
    Route::post('/status/{id}', 'UserController@status');

    Route::get('/media/{id}', 'HomeController@media')->name('media');
    Route::post('/media/{id}', 'UserController@media');

    Route::get('/delete/{id}', 'UserController@delete')->name('delete');

    Route::get('/logout', 'AuthController@logout');
});

Route::fallback(function(){
    return response()->view('errors.404', [], 404);
});

Route::get('/404', function () {
    return view('errors.404');
})->name('404');



