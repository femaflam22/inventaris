<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\LendingController;
use Illuminate\Support\Facades\Route;

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
    return view('landing-page');
})->name('landing-page');
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard')->middleware('isLogin');
Route::get('/error', function () {
    return view('error');
})->name('error');
Route::post('/auth', [AuthController::class, 'auth'])->name('auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['isLogin', 'cekRole:admin'])->prefix('/admin')->name('admin.')->group(function() {
    Route::prefix('/categories')->name('categories.')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('index');   
        Route::get('/add', function () {
            return view('admin.add-category');
        })->name('create');
        Route::post('/store', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [CategoryController::class, 'destroy'])->name('delete');
    });
    
    Route::prefix('/items')->name('items.')->group(function() {
        Route::get('/', [ItemController::class, 'index'])->name('index');
        Route::get('/add', [ItemController::class, 'create'])->name('create');
        Route::post('/store', [ItemController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [ItemController::class, 'edit'])->name('edit');
        Route::patch('/update/{id}', [ItemController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [ItemController::class, 'destroy'])->name('delete');
        Route::get('/export', [ItemController::class, 'export_mapping'])->name('export');
        Route::get('/lending/{item}', [ItemController::class, 'lending'])->name('lending');
    });

    // Route::prefix('/repairs')->name('repairs.')->group(function() {
    //     Route::get('/detail', function () {
    //         return view('admin.repair-detail');
    //     })->name('detail');
    //     Route::get('/', function () {
    //         return view('admin.repairs');
    //     })->name('index');
    // });
    
    Route::prefix('/users')->name('users.')->group(function(){
        Route::prefix('/accounts')->name('accounts.')->group(function() {
            Route::get('/add', function () {
                return view('admin.add-account');
            })->name('create');
            Route::post('/store', [AuthController::class, 'store'])->name('store');
            Route::get('/', [AuthController::class, 'admin'])->name('index');
            Route::delete('/delete/{id}', [AuthController::class, 'destroy'])->name('delete');
        });
        Route::get('/operators', [AuthController::class, 'operator'])->name('operators');
        Route::get('/reset/{id}', [AuthController::class, 'reset'])->name('reset');
        Route::get('/admin/export', [AuthController::class, 'export_admin'])->name('export-admin');
        Route::get('/operator/export', [AuthController::class, 'export_operator'])->name('export-operator');
    });
});

Route::middleware(['isLogin', 'cekRole:operator,admin'])->group(function() {
    Route::get('/accounts/edit/{id}', [AuthController::class, 'edit'])->name('users.accounts.edit');
    Route::patch('/users/change/{id}', [AuthController::class, 'change'])->name('users.change');
});

Route::middleware(['isLogin', 'cekRole:operator'])->prefix('/operator')->name('operator.')->group(function() {
    Route::get('/items', [ItemController::class, 'operator'])->name('items');
    Route::prefix('/lendings')->name('lendings.')->group(function (){
        Route::get('/', [LendingController::class, 'index'])->name('index');
        Route::get('/add', [LendingController::class, 'create'])->name('add');
        Route::post('/store', [LendingController::class, 'store'])->name('store');
        Route::delete('/delete/{id}', [LendingController::class, 'destroy'])->name('delete');
        Route::patch('/update/{id}', [LendingController::class, 'update'])->name('update');
        Route::get('/export', [LendingController::class, 'export_mapping'])->name('export');
    });
});
