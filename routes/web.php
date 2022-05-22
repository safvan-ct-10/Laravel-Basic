<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'App\Http\Controllers\LoginController@index')->name('admin.login');
Route::post('/login', 'App\Http\Controllers\LoginController@login')->name('login.post');

Route::group(['middleware' => 'admin_logged', 'namespace' => 'App\Http\Controllers'], function(){
    Route::get('/dashboard', 'LoginController@home')->name('admin.home');
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');
});
