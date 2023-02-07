<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\http\Controllers\DashboardController;
use App\Http\Controllers\ServiceDoneController;
use App\Http\Controllers\ServicePendingController;
use App\Http\Controllers\MonitorController;
use App\Http\Controllers\KanibalController;
use App\Http\Controllers\ProductviewController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('productview.index');
});


//login new
Route::middleware(['middleware'=>'PreventBackHistory'])->group(function () {
    Auth::routes();
});

Route::group(['prefix'=>'user', 'middleware'=>['isUser','auth','PreventBackHistory']], function(){
    Route::get('/productview', [ProductviewController::class,'index'])->name('user.dashboard');

});

//Login
// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login', [LoginController::class, 'authenticate']);
// Route::post('/logout', [LoginController::class, 'logout']);

// //Register
// Route::get('/register', [RegisterController::class, 'index']);
// Route::post('/register', [RegisterController::class, 'store']);

//Forgot Password
// Route::post('/forgotpassword', [ForgotPasswordController::class, 'store'])->middleware('guest')->name('password.email');


//Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

//Monitor
Route::get('/monitor', [MonitorController::class, 'index']);
Route::get('/monitor/total', [MonitorController::class, 'total']);

//ServiceDone
Route::post('/servicedone/import_excel', [ServiceDoneController::class, 'import_excel']);
Route::get('/servicedone/export_excel', [ServiceDoneController::class, 'export_excel']);
Route::get('/servicedone/cari', [ServiceDoneController::class, 'cari']);

Route::resource('/servicedone', ServiceDoneController::class)->except([
    'show', 'edit', 'update', 'destroy',
    ]);

Route::get('/servicedone/{barang:id}/edit', [ServiceDoneController::class, 'edit'])->middleware('auth');
Route::put('/servicedone/{barang:id}', [ServiceDoneController::class, 'update'])->middleware('auth');
Route::get('/servicedone/show/{barang:id}', [ServiceDoneController::class, 'show']);
Route::delete('/servicedone/{barang:id}', [ServiceDoneController::class, 'destroy'])->middleware('auth');

//ServicePending
// Route::resource('/servicepending', ServicePendingController::class)->middleware('auth');
Route::get('/servicepending/export_excel', [ServicePendingController::class, 'export_excel']);
Route::get('/servicepending/cari', [ServicePendingController::class, 'cari']);

Route::resource('/servicepending', ServicePendingController::class)->except([
    'show', 'destroy', 'edit', 'update',
]);

Route::get('/servicepending/{barangsp:id}/edit', [ServicePendingController::class, 'edit'])->middleware('auth');
Route::put('/servicepending/{barangsp:id}', [ServicePendingController::class, 'update'])->middleware('auth');
Route::get('/servicepending/show/{barangsp:id}', [ServicePendingController::class, 'show']);
Route::get('/servicepending/finish/{barangsp:id}', [ServicePendingController::class, 'finish']);
Route::delete('/servicepending/{barangsp:id}', [ServicePendingController::class, 'destroy'])->middleware('auth');

//kanibal
Route::get('/kanibal/export_excel', [KanibalController::class, 'export_excel']);
Route::get('/kanibal/cari', [KanibalController::class, 'cari']);

Route::resource('/kanibal', KanibalController::class)->except([
    'show', 'destroy', 'edit', 'update',
]);

Route::get('/kanibal/{kanibal:id}/edit', [KanibalController::class, 'edit'])->middleware('auth');
Route::put('/kanibal/{kanibal:id}', [KanibalController::class, 'update'])->middleware('auth');
Route::get('/kanibal/show/{kanibal:id}', [KanibalController::class, 'show']);
Route::get('/kanibal/finish/{kanibal:id}', [KanibalController::class, 'finish']);
Route::delete('/kanibal/{kanibal:id}', [KanibalController::class, 'destroy'])->middleware('auth');

//productview
Route::get('/productview', [ProductviewController::class, 'index']);



