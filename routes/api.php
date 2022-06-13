<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [ApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/getUser', [ApiController::class, 'getUser']);
    Route::post('/logout', [ApiController::class, 'logout']);
});
