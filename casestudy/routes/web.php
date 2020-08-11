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

Route::get('/dashboard', 'DashboardController@index')->name('dashboard')->middleware('auth');