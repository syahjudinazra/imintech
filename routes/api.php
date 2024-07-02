<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\SparepartsController;
use App\Http\Controllers\Api\FirmwaresController;
use App\Http\Controllers\Api\LogSparepartsController;
use App\Http\Controllers\Api\PinjamController;
use App\Http\Controllers\Api\PinjamDeviceController;
use App\Http\Controllers\Api\ServicesController;
use App\Http\Controllers\Api\ServicesDeviceController;
use App\Http\Controllers\Api\StocksController;
use App\Http\Controllers\Api\StocksDeviceController;
use App\Http\Controllers\Api\StocksSkuController;

use function Laravel\Prompts\search;

/**Authentication */
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
Route::post('/logout', LogoutController::class)->name('logout');

Route::middleware(['auth:api'])->group(function () {
/**Spareparts */
Route::get('/getspareparts', [SparepartsController::class, 'index']);
Route::post('/addspareparts', [SparepartsController::class, 'store'])->name('add.spareparts');
Route::get('/viewspareparts/{id}', [SparepartsController::class, 'show'])->name('view.spareparts');
Route::put('/updatespareparts/{id}', [SparepartsController::class, 'update'])->name('update.spareparts');
Route::delete('/destroyspareparts/{id}', [SparepartsController::class, 'destroy'])->name('delete.spareparts');
Route::put('/updatequantity/{id}', [SparePartsController::class, 'updateQuantity'])->name('update.quantity');

/**Spareparts */
Route::get('/getlogspareparts', [LogSparepartsController::class, 'index']);

/**Firmwares */
Route::get('/getfirmwares', [FirmwaresController::class, 'index']);
Route::get('/getfirmwarestable', [FirmwaresController::class, 'table']);
Route::post('/addfirmwares', [FirmwaresController::class, 'store'])->name('add.firmwares');
Route::get('/viewfirmwares/{id}', [FirmwaresController::class, 'show'])->name('view.firmwares');
Route::put('/updatefirmwares/{id}', [FirmwaresController::class, 'update'])->name('update.firmwares');
Route::delete('/destroyfirmwares/{id}', [FirmwaresController::class, 'destroy'])->name('delete.firmwares');

/**Services */
Route::get('/getservices', [ServicesController::class, 'index']);
Route::post('/addservices', [ServicesController::class, 'store'])->name('add.services');
Route::get('/viewservices/{id}', [ServicesController::class, 'show'])->name('view.services');
Route::put('/updateservices/{id}', [ServicesController::class, 'update'])->name('update.services');
Route::put('/moveservices/{id}', [ServicesController::class, 'move'])->name('move.services');
Route::delete('/destroyservices/{id}', [ServicesController::class, 'destroy'])->name('delete.services');
Route::get('services/export', [ServicesController::class, 'export'])->name('export.services');

Route::get('/antrianPelanggan', [ServicesController::class, 'antrianPelanggan'])
    ->name('service.antrianPelanggan');
Route::get('/validasiPelanggan', [ServicesController::class, 'validasiPelanggan'])
    ->name('service.validasiPelanggan');
Route::get('/selesaiPelanggan', [ServicesController::class, 'selesaiPelanggan'])
    ->name('service.selesaiPelanggan');
Route::get('/antrianStock', [ServicesController::class, 'antrianStock'])
    ->name('service.antrianStock');
Route::get('/validasiStock', [ServicesController::class, 'validasiStock'])
    ->name('service.validasiStock');
Route::get('/selesaiStock', [ServicesController::class, 'selesaiStock'])
    ->name('service.selesaiStock');

/**Pinjam */
Route::get('/getpinjam', [PinjamController::class, 'index']);
Route::get('/getkembali', [PinjamController::class, 'kembali']);
Route::post('/addpinjam', [PinjamController::class, 'store'])->name('add.pinjam');
Route::get('/viewpinjam/{id}', [PinjamController::class, 'show'])->name('view.pinjam');
Route::put('/updatepinjam/{id}', [PinjamController::class, 'update'])->name('update.pinjam');
Route::put('/movepinjam/{id}', [PinjamController::class, 'move'])->name('move.pinjam');
Route::delete('/destroypinjam/{id}', [PinjamController::class, 'destroy'])->name('delete.pinjam');

/**Stocks */
Route::get('/getstocks', [StocksController::class, 'index']);
Route::post('/addstocks', [StocksController::class, 'store'])->name('add.stocks');
Route::get('/viewstocks/{id}', [StocksController::class, 'show'])->name('view.stocks');
Route::put('/updatestocks/{id}', [StocksController::class, 'update'])->name('update.stocks');
Route::delete('/destroystocks/{id}', [StocksController::class, 'destroy'])->name('delete.stocks');

Route::get('stocks/gudang', [StocksController::class, 'gudang'])->name('stocks.gudang');
Route::get('stocks/diservice', [StocksController::class, 'diservice'])->name('stocks.diservice');
Route::get('stocks/dipinjam', [StocksController::class, 'dipinjam'])->name('stocks.dipinjam');
Route::get('stocks/terjual', [StocksController::class, 'terjual'])->name('stocks.terjual');

/**List Device Stocks */
Route::get('/getliststocks', [StocksDeviceController::class, 'index']);
Route::post('/addsliststocks', [StocksDeviceController::class, 'store'])->name('add.liststocks');
Route::put('/updateliststocks/{id}', [StocksDeviceController::class, 'update'])->name('update.liststocks');
Route::delete('/destroyliststocks/{id}', [StocksDeviceController::class, 'destroy'])->name('delete.liststocks');

/**List Device Stocks SKU */
Route::get('/getliststockssku', [StocksSkuController::class, 'index']);
Route::post('/addsliststockssku', [StocksSkuController::class, 'store'])->name('add.liststockssku');
Route::put('/updateliststockssku/{id}', [StocksSkuController::class, 'update'])->name('update.liststockssku');
Route::delete('/destroyliststockssku/{id}', [StocksSkuController::class, 'destroy'])->name('delete.liststockssku');

/**List Device Pinjam */
Route::get('/getlistpinjam', [PinjamDeviceController::class, 'index']);
Route::post('/addslistpinjam', [PinjamDeviceController::class, 'store'])->name('add.listpinjam');
Route::put('/updatelistpinjam/{id}', [PinjamDeviceController::class, 'update'])->name('update.listpinjam');
Route::delete('/destroylistpinjam/{id}', [PinjamDeviceController::class, 'destroy'])->name('delete.listpinjam');

/**List Device Services */
Route::get('/getlistservices', [ServicesDeviceController::class, 'index']);
Route::post('/addslistservices', [ServicesDeviceController::class, 'store'])->name('add.listservices');
Route::put('/updatelistservices/{id}', [ServicesDeviceController::class, 'update'])->name('update.listservices');
Route::delete('/destroylistservices/{id}', [ServicesDeviceController::class, 'destroy'])->name('delete.listservices');

});
