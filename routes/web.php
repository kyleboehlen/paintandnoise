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

// Auth
Auth::routes(['verify' => true]);

// Root Route
Route::get('/', 'HomeController@index')->name('root');

// Home Route
Route::get('/home', 'HomeController@home')->middleware('auth')->middleware('verified')->name('home');

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

    // User Profile Pictures
    Route::get('/user/profile-picture', 'AssetController@profilePicture')->middleware('auth')->name('assets.profile-picture');
});

// Account management
Route::prefix('/account')->group(function(){
    // Root
    Route::get('/', 'AccountManagementController@index')->name('account');

    // Categories Flow
    Route::prefix('/categories')->group(function(){
        Route::get('/', 'AccountManagementController@showCategories')->name('account.categories');
        Route::get('/{parent_id}', 'AccountManagementController@showCategories')->name('account.subcategories');
        Route::post('/update', 'AccountManagementController@updateCategories')->name('account.categories.update');
    });
});