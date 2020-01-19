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

// php.ini
Route::get('/phpinfo', 'Debug\DebugController@phpInfo')->name('debug.phpinfo');

// Test
Route::get('/test', 'Debug\DebugController@test')->name('debug.test');

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

    // Update Account Info
    Route::prefix('/update')->group(function(){
        Route::post('/name', 'AccountManagementController@updateName')->name('account.update.name');
        Route::post('/profile-picture', 'AccountManagementController@updateProfilePicture')->name('account.update.profile-picture');
        Route::post('/nsfw', 'AccountManagementController@updateNSFW')->name('account.update.nsfw');
        Route::post('/password', 'AccountManagementController@updatePassword')->name('account.update.password');
    });
});

// Admin
Route::prefix('/admin')->group(function(){

    // Root
    Route::get('/', 'Admin\AdminController@index')->name('admin');
    Route::get('/home', 'Admin\AdminController@home')->middleware('auth:admin')->name('admin.home');

    //Login Routes
    Route::get('/login','Admin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login','Admin\LoginController@login');
    Route::post('/logout','Admin\LoginController@logout')->name('admin.logout');

    // Admin Users Tool
    Route::prefix('/users')->group(function(){
        Route::get('/', 'Admin\AdminUsersController@index')->name('admin.users');

        // Redirect 
        Route::post('/redirect', 'Admin\AdminUsersController@redirect')->name('admin.users.redirect');

        // Create
        Route::post('/create', 'Admin\AdminUsersController@create')->name('admin.users.create');
    });

    // Admin Reported Posts Tool
    Route::prefix('/reported-posts')->group(function(){
        Route::get('/', 'Admin\ReportedPostsController@index')->name('admin.reported-posts');
    });

    // Admin Poster Users
    Route::prefix('/posters')->group(function(){
        Route::get('/', 'Admin\PostersController@index')->name('admin.posters');
    });

    // Admin Stats Page
    Route::prefix('/stats')->group(function(){
        Route::get('/', 'Admin\StatsController@index')->name('admin.stats');
    });
});