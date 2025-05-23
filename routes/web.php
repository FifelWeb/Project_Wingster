<?php

use App\Http\Controllers\MenuController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
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

/*Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home.index');*/


/*Route Login*/
Route::get('/login',[\App\Http\Controllers\AuthController::class,'index'])->name('auth.login');
Route::post('/login',[\App\Http\Controllers\AuthController::class,'verify'])->name('auth.verify');

/*Route Dashboard*/
Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
});

/*Route Transaction*/
Route::group(['prefix' => 'transaction'],function(){
    Route::get('/', [TransactionController::class, 'index'])->name('transaction.index');
    Route::post('/search-barcode', [TransactionController::class, 'searchProduct'])->name('transaction.searchProduct');
    Route::post('/insert', [TransactionController::class, 'insert'])->name('transaction.insert');
    Route::post('/get-pesanan', [TransactionController::class, 'pesanan'])->name('transaction.pesanan');
});

Route::group(['middleware' =>['auth:user'] ],function () {
   Route::prefix('dashboard')->group(function () {

       /*Category*/
       Route::get('/category',[CategoryController::class, 'index'])->name('category.index');
       Route::get('/category/add',[CategoryController::class, 'add'])->name('category.add');
       Route::post('/category/store',[CategoryController::class, 'store'])->name('category.store');
       Route::get('/category/edit{id}',[CategoryController::class, 'edit'])->name('category.edit');
       Route::post('/category/update',[CategoryController::class, 'update'])->name('category.update');
       Route::post('/category/delete{id}',[CategoryController::class, 'delete'])->name('category.delete');

       /*Route Menu*/
       Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
       Route::get('/menu/add', [MenuController::class, 'add'])->name('menu.add');
       Route::post('/menu/store', [MenuController::class, 'store'])->name('menu.store');
       Route::get('/menu/edit{id}', [MenuController::class, 'edit'])->name('menu.edit');
       Route::put('/menu/update{id}', [MenuController::class, 'update'])->name('menu.update');
       Route::delete('menu/delete{id}', [MenuController::class, 'delete'])->name('menu.delete');

   });
});
/*Route Storage*/
Route::get('files/{filename}', function ($filename) {
    $path = storage_path('app/public/'.$filename);
    if (!File::exists($path)){
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
})->name('storage');

