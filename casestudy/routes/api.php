<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get-users', 'UserController@index')->name('get.users');

Route::patch('/lock-user', 'UserController@lock')->name('lock.user');

// Route::apiResource('user', 'UserController');

Route::get('/get-banners', 'BannerImageController@index')->name('get.banners');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
