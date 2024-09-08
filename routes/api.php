<?php

use App\Http\Controllers\BlogAPiController;
use App\Http\Controllers\ServiceApiController;
use App\Http\Controllers\ServiceDetailApiController;
use App\Http\Controllers\ServiceKeyPointsApiController;
use App\Models\ServiceKeyPoint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('blogs')->group(function () {
    Route::get('/latest', [BlogAPiController::class, 'latest']);
    Route::get('/{id}', [BlogAPiController::class, 'show']);
    Route::get('/', [BlogAPiController::class, 'index']);
});
 Route::prefix('services')->group(function () {
    
    Route::prefix('service-detail')->group(function (){
        Route::get('/{id}', [ServiceDetailApiController::class, 'show']);
        Route::get('/', [ServiceDetailApiController::class, 'index']);
        
    });
    Route::prefix('service-key-points')->group(function (){
        Route::get('/', [ServiceKeyPointsApiController::class, 'index']);
Route::get('/{id}', [ServiceKeyPointsApiController::class, 'show']);
    });
    Route::get('/{id}', [ServiceApiController::class, 'show']);
    Route::get('/', [ServiceApiController::class, 'index']);

 });
  