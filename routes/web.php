<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Dashboard\BlogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});
Route::post('/test',[AuthenticatedSessionController::class, 'store'])->name('test');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::controller(BlogController::class)->group(function () {
    Route::get('/index', 'index')->name('blog');
    Route::get('/show/{id}', 'show')->name('blogDetails');
    Route::get('/blogForm', 'blogForm')->name('blogForm');
    Route::post('/addBlog', 'addBlog')->name('addBlog');
    Route::get('/edit-form/{id}', 'editForm')->name('blogEdit');
    Route::post('/updateBlog/{id}', 'updateBlog')->name('updateBlog');

});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index')->name('categories');
    // Route::get('/show/{id}', 'show')->name('blogDetails');
    Route::get('/addCategory', 'addCategory')->name('addCategory');
    Route::post('/addCategory', 'store')->name('storeCategory');
    Route::get('/edit-category/{id}', 'edit')->name('categoryEdit');
    Route::post('/updateCategory/{id}', 'update')->name('updateCategory');
    Route::get('/categoryDelete/{id}', 'destroy')->name('categoryDelete');

});

Route::prefix('service')->group(function () {
Route::controller(ServiceController::class)->group(function () {
    Route::get('/index', 'index')->name('showServices');
    // Route::get('/show/{id}', 'show')->name('blogDetails');
    Route::get('/service-form', 'serviceForm')->name('serviceForm');
    Route::post('/add', 'store')->name('addService');
    Route::get('/edit/{id}', 'edit')->name('editService');
    Route::post('/updateService/{id}', 'update')->name('updateService');
    Route::get('/service-delete/{id}', 'delete')->name('deleteService');

});
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
