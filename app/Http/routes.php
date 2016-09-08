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

/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::group([ 'middleware' => ['web'] ], function () {
 
    Route::get('/', function () {
        $app = app();
        return view('site.home', [
            'app_version' => $app::VERSION,
            'user' => '', // put user info here
        ]);
    });
    
    Route::get('/fb/login', 'FacebookController@login')->name('fb-login'); 
    Route::get('/fb/login-callback', 'FacebookController@loginCallback'); 
    Route::get('/fb/inspect/{id}', 'FacebookController@inspect'); 
    Route::get('/fb/lookup/{url?}', 'FacebookController@lookup'); 
    Route::post('/fb/lookup/save', 'FacebookController@lookupSave');
    
    Route::get('/locations', 'LocationController@index')->name('locations');
    Route::get('/locations/delete/{location}', 'LocationController@delete');
    
});