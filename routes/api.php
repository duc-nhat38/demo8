<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get-users', 'UserController@index')->name('get.users');

Route::get('/show-user', 'UserController@show')->name('show.user');

Route::patch('/lock-user', 'UserController@lock')->name('lock.user');

Route::patch('/power-user', 'UserController@power')->name('power.user');

Route::patch('/update-user', 'UserController@update')->name('update.user');

Route::post('/update-avatar-user', 'UserController@updateAvatar')->name('update.avatar');
// Route::apiResource('user', 'UserController');

Route::get('/get-banners', 'BannerImageController@index')->name('get.banners');

Route::get('/get-banners-slide', 'BannerImageController@bannerSlide')->name('banners.slide');

Route::get('/get-banner-detail', 'BannerImageController@show')->name('banner.detail');

Route::post('/banner-update', 'BannerImageController@update')->name('banner.update');

Route::post('/banner-create', 'BannerImageController@store')->name('banner.create');

Route::delete('/banner-destroy', 'BannerImageController@destroy')->name('banner.destroy');
// post
Route::get('/get-posts', 'PostController@index')->name('get.posts');

Route::get('/get-post-detail', 'PostController@show')->name('post.detail');

Route::get('/get-post-news', 'PostController@getPostNews')->name('post.news');

Route::post('/post-create', 'PostController@store')->name('post.create');

Route::post('/post-update', 'PostController@update')->name('post.update');

Route::delete('/post-destroy', 'PostController@destroy')->name('post.destroy');
// address
Route::get('/get-address', 'AddressController@index')->name('get.address');

Route::get('/get-address-all', 'AddressController@getAddressAll')->name('address.all');

Route::get('/get-address-detail', 'AddressController@show')->name('address.detail');

Route::put('/address-update', 'AddressController@update')->name('address.update');

Route::delete('/address-destroy', 'AddressController@destroy')->name('address.destroy');
// district
Route::get('/get-district', 'DistrictController@index')->name('get.district');

Route::get('/get-district-detail', 'DistrictController@show')->name('district.detail');

Route::put('/district-update', 'DistrictController@update')->name('district.update');

Route::delete('/district-destroy', 'DistrictController@destroy')->name('district.destroy');
// business
Route::get('/get-business', 'BusinessTypeController@index')->name('get.business');
// house
Route::get('/get-houses', 'HouseController@index')->name('get.houses');

Route::get('/get-house-detail', 'HouseController@houseDetail')->name('house.detail');

Route::get('/get-house-photos', 'HouseController@getPhotos')->name('house.photos');

Route::get('/get-house-comments', 'HouseController@getComments')->name('house.comments');

Route::get('/get-house-my-vote', 'HouseController@getMyVote')->name('house.vote');

Route::get('/get-house-votes', 'HouseController@getVotes')->name('house.votes');

Route::post('/vote-house', 'HouseController@rate')->name('vote.house');

Route::post('/comment-house', 'HouseController@comment')->name('comment.house');

Route::delete('/house-delete', 'HouseController@houseDelete')->name('house.delete');

Route::delete('/comment-delete', 'HouseController@delComment')->name('comment.delete');

Route::put('/comment-house-edit', 'HouseController@editComment')->name('comment.edit');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
