<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


/*Route Login*/
Route::get('/login',[\App\Http\Controllers\AuthController::class,'index'])->name('auth.login');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'verify'])->name('auth.verify');

/*Route Dahsboard*/
Route::group(['middleware' =>['auth'] ],function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

Route::group(['prefix' => 'transaction'],function(){
    Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/search-barcode', [TransactionController::class, 'searchProduct'])->name('transaction.searchProduct');
    Route::post('/insert', [TransactionController::class, 'insert'])->name('transaction.insert');
});
