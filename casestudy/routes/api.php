<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get-users', 'UserController@index')->name('get.users');

Route::get('/show-user', 'UserController@show')->name('show.user');

Route::patch('/lock-user', 'UserController@lock')->name('lock.user');

Route::patch('/power-user', 'UserController@power')->name('power.user');
// Route::apiResource('user', 'UserController');

Route::get('/get-banners', 'BannerImageController@index')->name('get.banners');

Route::get('/get-banner-detail', 'BannerImageController@show')->name('banner.detail');

Route::put('/banner-update', 'BannerImageController@update')->name('banner.update');

Route::post('/banner-create', 'BannerImageController@store')->name('banner.create');

Route::delete('/banner-destroy', 'BannerImageController@destroy')->name('banner.destroy');
// post
Route::get('/get-posts', 'PostController@index')->name('get.posts');

Route::get('/get-post-detail', 'PostController@show')->name('post.detail');

Route::post('/post-create', 'PostController@store')->name('post.create');

Route::post('/post-update', 'PostController@update')->name('post.update');

Route::delete('/post-destroy', 'PostController@destroy')->name('post.destroy');
// address
Route::get('/get-address', 'AddressController@index')->name('get.address');

Route::get('/get-address-detail', 'AddressController@show')->name('address.detail');

Route::post('/address-create', 'AddressController@store')->name('address.create');

// district
Route::get('/get-district', 'DistrictController@index')->name('get.district');

Route::get('/get-district-detail', 'DistrictController@show')->name('district.detail');

Route::post('/district-create', 'DistrictController@store')->name('district.create');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
