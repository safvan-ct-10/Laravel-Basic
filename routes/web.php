<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'index'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');

Route::group(['middleware' => 'admin', 'prefix' => 'backend-admin', 'as' => 'admin.'], function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('dashboard', [Admin\HomeController::class, 'index'])->name('home');

    Route::get('users', [Admin\UserController::class, 'index'])->name('users');
    Route::get('trashed', [Admin\UserController::class, 'trashed'])->name('users.trashed');
    Route::get('create', [Admin\UserController::class, 'create'])->name('users.create');
    Route::post('store', [Admin\UserController::class, 'store'])->name('users.store');
    Route::get('edit/{id}', [Admin\UserController::class, 'edit'])->name('users.edit');
    Route::patch('update', [Admin\UserController::class, 'update'])->name('users.update');
    Route::get('delete/{id}', [Admin\UserController::class, 'delete'])->name('users.delete');
    Route::get('recover-delete/{id}', [Admin\UserController::class, 'recoverUser'])->name('users.recover-delete');
    Route::get('force-delete/{id}', [Admin\UserController::class, 'forceDelete'])->name('users.force-delete');
});
