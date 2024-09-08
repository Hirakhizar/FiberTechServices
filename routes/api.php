<?php

use App\Http\Controllers\BlogAPiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

    Route::get('/blogs', [BlogAPiController::class, 'latest']);
    Route::get('/blogs/{id}', [BlogAPiController::class, 'show']);
    Route::get('/blogs/latest', [BlogAPiController::class, 'latest']);
