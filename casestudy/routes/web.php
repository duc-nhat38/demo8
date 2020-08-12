<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/api/listadress', 'HomePageController@getListAddress');

Route::get('/api/listaddressdetails', 'HomePageController@getListAddressDetails');

Route::get('/api/getaddressdetails/{id}', 'HomePageController@getAddressDetails');


Route::get('/', 'HomePageController@index');

Route::get('/post-detail/{id}', 'PostController@show')->name('post-detail');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'dashboard', 'auth' => 'login'], function () {

    Route::get('/', 'DashboardController@index')->name('dashboard')->middleware('auth');

    Route::get('/user-manager', 'DashboardController@userManager')->name('user.manager');

    Route::get('/banner-manager', 'DashboardController@bannerManager')->name('banner.manager');

    Route::get('/post-manager', 'DashboardController@postManager')->name('post.manager');

    Route::get('/address-manager', 'DashboardController@addressManager')->name('address.manager');


});
