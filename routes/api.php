<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SparepartsController;

/**Authentication */
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
Route::post('/logout', LogoutController::class)->name('logout');

/**Spareparts */
Route::get('/getspareparts', [SparepartsController::class, 'index']);
Route::post('/addspareparts', [SparepartsController::class, 'store'])->name('add.spareparts');
Route::get('/viewspareparts/{id}', [SparepartsController::class, 'show'])->name('view.spareparts');
Route::put('/updatespareparts/{id}', [SparepartsController::class, 'update'])->name('update.spareparts');
Route::delete('/destroyspareparts/{id}', [SparepartsController::class, 'destroy'])->name('delete.spareparts');
