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

// Root Route
Route::get('/', 'HomeController@index')->name('root');

// Home Route
Route::get('/home', 'HomeController@home')->name('home');

// About Route
Route::get('/about', 'HomeController@about')->name('about');

// Assets
Route::prefix('/assets')->group(function(){
    // Main logo
    Route::get('/logo', 'AssetController@logo')->name('assets.logo');
    
    // Icons
    Route::get('/icon/{identifier}', 'AssetController@icon')->name('assets.icon');
});