<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', 'HomePageController@index')->name('home');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['auth']], function () {
    Route::group(['prefix' => 'dashboard'], function () {

        Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('auth');
    
        Route::get('/user-manager', 'DashboardController@userManager')->name('user.manager');
    
        Route::get('/banner-manager', 'DashboardController@bannerManager')->name('banner.manager');
    
        Route::get('/post-manager', 'DashboardController@postManager')->name('post.manager');
    
        Route::get('/address-manager', 'DashboardController@addressManager')->name('address.manager');
    
    });

    Route::get('/user-information/{id}', 'UserController@userInformation')->name('user.information');

    Route::post('/house-create', 'HouseController@store')->name('house.create');
    
    Route::post('/house-update', 'HouseController@update')->name('house.update');

});

Route::get('/house/{id}', 'HouseController@show')->name('house.show');

Route::get('/post/{id}', 'PostController@postDetail')->name('post.show');

Route::get('/business/{id}', 'HouseController@businessHouse')->name('business.house');

Route::get('/user/{id}', 'UserController@getUser')->name('get.user');

Route::get('/address-house/{id}', 'HouseController@getAddressHouse')->name('address.house');

Route::get('/district-house/{id}', 'HouseController@getDistrictHouse')->name('district.house');

Route::get('/posts', 'PostController@all')->name('post.all');

Route::get('/search', 'HomePageController@search')->name('search');
