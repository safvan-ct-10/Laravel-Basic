<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::group(['middleware' => 'admin', 'prefix' => 'backend-admin', 'as' => 'admin.'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [Admin\HomeController::class, 'index'])->name('home');

    // USERS ROUTES
    Route::get('users', [Admin\UserController::class, 'index'])->name('users');
    Route::get('users/trashed', [Admin\UserController::class, 'trashed'])->name('users.trashed');
    Route::get('users/create', [Admin\UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [Admin\UserController::class, 'store'])->name('users.store');
    Route::get('users/edit/{id}', [Admin\UserController::class, 'edit'])->name('users.edit');
    Route::patch('users/update', [Admin\UserController::class, 'update'])->name('users.update');
    Route::get('users/delete/{id}', [Admin\UserController::class, 'delete'])->name('users.delete');
    Route::get('users/recover-delete/{id}', [Admin\UserController::class, 'recoverUser'])->name('users.recover-delete');
    Route::get('users/force-delete/{id}', [Admin\UserController::class, 'forceDelete'])->name('users.force-delete');

    // COUNTRY ROUTES
    Route::get('country', [Admin\CountryController::class, 'index'])->name('country');
    Route::get('country/create', [Admin\CountryController::class, 'create'])->name('country.create');
    Route::post('country/store', [Admin\CountryController::class, 'store'])->name('country.store');
    Route::get('country/edit/{country}', [Admin\CountryController::class, 'edit'])->name('country.edit');
    Route::patch('country/update/{country}', [Admin\CountryController::class, 'update'])->name('country.update');
    Route::get('country/delete/{country}', [Admin\CountryController::class, 'destroy'])->name('country.delete');
});
