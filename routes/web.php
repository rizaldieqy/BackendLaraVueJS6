<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
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
    return view('auth.login');
});

Route::prefix('admin')->group(function(){
    
    Route::group(['middleware' => 'auth'], function(){     
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        // Route::get('/category', [CategoryController::class, 'index'])->name('admin.category.index');
        // Route::get('/category-create', [CategoryController::class, 'create'])->name('admin.category.create');
        // Route::post('/category-store', [CategoryController::class, 'update'])->name('admin.category.store');
    });

    Route::resource('/category', CategoryController::class, ['as' => 'admin']);
});
    