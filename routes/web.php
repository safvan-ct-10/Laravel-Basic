<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::group(['middleware' => 'admin', 'prefix' => 'backend-admin'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('admin.logout');
    Route::get('dashboard', [Admin\HomeController::class, 'index'])->name('admin.home');
});
