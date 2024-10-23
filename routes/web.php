<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Manager\ManagerController as ManagerController;
use App\Http\Controllers\Admin\AdminController as AdminController;
use App\Http\Controllers\Admin\ItemController as ItemController;
use App\Http\Controllers\Admin\CategoryController as CategoryController;
use App\Http\Controllers\Admin\HourController as HourController;
use GuzzleHttp\Middleware;
use Illuminate\Routing\Controllers\Middleware as ControllersMiddleware;

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // # Manager
    Route::get('/schools', [ManagerController::class, 'indexSchool'])->name('manager.index');
    Route::post('/schools', [ManagerController::class, 'storeSchool'])->name('manager.store');
    Route::get('/schools/trashed', [ManagerController::class, 'trashedSchools'])->name('manager.trashed');
    Route::delete('/schools/{school}/forcedelete', [ManagerController::class, 'forceDeleteSchool'])->name('manager.forceDelete');
    Route::delete('/schools/{school}', [ManagerController::class, 'deleteSchool'])->name('manager.delete');
    // # Items
    Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
    Route::post('/item/create', [ItemController::class, 'store'])->name('item.store');
    Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');
    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/item/{id}/update', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/item/{id}/delete', [ItemController::class, 'delete'])->name('item.delete');
    // # Category
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
    // Route::resource('provaroute', ManagerController::class);
});

