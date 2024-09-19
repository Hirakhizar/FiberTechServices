<?php

use App\Http\Controllers\BlogAPiController;
use App\Http\Controllers\QuoteApiController;
use App\Http\Controllers\ServiceApiController;
use App\Http\Controllers\ServiceDetailApiController;
use App\Http\Controllers\serviceInquiryMailController;
use App\Http\Controllers\ServiceKeyPointsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('blogs')->group(function () {
    Route::get('/latest', [BlogAPiController::class, 'latest']);
    Route::get('/blog-details/{id}', [BlogAPiController::class, 'show']);
    Route::get('/list', [BlogAPiController::class, 'index']);
});
 Route::prefix('service')->group(function () {
    Route::get('/list', [ServiceDetailApiController::class, 'services']);
    Route::get('/details/{id}', [ServiceDetailApiController::class, 'show']);
    Route::get('/', [ServiceDetailApiController::class, 'index']);
    });

Route::post('/send-inquiry-email', [serviceInquiryMailController::class, 'sendEmail']);
Route::post('/request-quote', [serviceInquiryMailController::class, 'getQuote']);







