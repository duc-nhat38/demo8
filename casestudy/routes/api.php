<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get-users', 'UserController@index')->name('get.users');

Route::get('/show-user', 'UserController@show')->name('show.user');

Route::patch('/lock-user', 'UserController@lock')->name('lock.user');

Route::patch('/power-user', 'UserController@power')->name('power.user');
// Route::apiResource('user', 'UserController');

Route::get('/get-banners', 'BannerImageController@index')->name('get.banners');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
