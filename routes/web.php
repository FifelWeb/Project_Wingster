<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;


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

/*Route Dashboard*/
/*Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');*/

/*Route Transaction*/
Route::group(['prefix' => 'transaction'],function(){
    Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/search-barcode', [TransactionController::class, 'searchProduct'])->name('transaction.searchProduct');
    Route::post('/insert', [TransactionController::class, 'insert'])->name('transaction.insert');
    Route::post('/get-pesanan', [TransactionController::class, 'pesanan'])->name('transaction.pesanan');
});

Route::group(['middleware' =>['auth:user'] ],function () {
   Route::prefix('admin')->group(function () {
       /*Dashboard*/
       Route::get('/dashboard',[\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');


       /*Category*/
       Route::get('/category',[CategoryController::class, 'index'])->name('category.index');
       Route::get('/category/add',[CategoryController::class, 'add'])->name('categories.add');
       Route::post('/category/store',[CategoryController::class, 'store'])->name('categories.store');
       /*Route::get('/category/edit{id}',[CategoryController::class, 'edit'])->name('categories.edit');
       Route::post('/category/update',[CategoryController::class, 'update'])->name('categories.update');
       Route::post('/category/delete{id}',[CategoryController::class, 'delete'])->name('categories.delete');*/
   });
});
