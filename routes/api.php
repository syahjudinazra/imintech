<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SparepartsController;
use App\Http\Controllers\Api\FirmwaresController;
use App\Http\Controllers\Api\ServicesController;

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

/**Firmwares */
Route::get('/getfirmwares', [FirmwaresController::class, 'index']);
Route::post('/addfirmwares', [FirmwaresController::class, 'store'])->name('add.firmwares');
Route::get('/viewfirmwares/{id}', [FirmwaresController::class, 'show'])->name('view.firmwares');
Route::put('/updatefirmwares/{id}', [FirmwaresController::class, 'update'])->name('update.firmwares');
Route::delete('/destroyfirmwares/{id}', [FirmwaresController::class, 'destroy'])->name('delete.firmwares');

/**Services */
Route::get('/getservices', [ServicesController::class, 'index']);
Route::post('/addservices', [ServicesController::class, 'store'])->name('add.services');
Route::get('/viewservices/{id}', [ServicesController::class, 'show'])->name('view.services');
Route::put('/updateservices/{id}', [ServicesController::class, 'update'])->name('update.services');
Route::delete('/destroyservices/{id}', [ServicesController::class, 'destroy'])->name('delete.services');
