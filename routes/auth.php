<?php

use App\Http\Controllers\UserController;
use Illuminate\Routing\Route;


Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [UserController::class, 'logout']);
