<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/get-users', 'UserController@index')->name('get.users');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
