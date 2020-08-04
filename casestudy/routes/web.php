<?php

use Illuminate\Support\Facades\Route;
Route::get("formLogin", "LoginController@formLogin");

Route::post("login", "LoginController@index");
// 
Route::get('/', function () {
    return view('welcome');
});
