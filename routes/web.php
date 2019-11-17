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

    // About Page Images
    Route::get('/about', 'AssetController@about')->name('assets.about');
    Route::get('/how', 'AssetController@how')->name('assets.how');
    Route::get('/why', 'AssetController@why')->name('assets.why');
    
    // Icons
    Route::get('/icon/{identifier}', 'AssetController@icon')->name('assets.icon');

    // Team Member Pictures
    Route::get('/team/{name}', 'AssetController@team')->name('assets.team');
});