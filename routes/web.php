<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerController as ManagerController;
use App\Http\Controllers\Admin\AdminController as AdminController;
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
    Route::get('/schools', [ManagerController::class, 'indexSchool'])->name('manager.index');
    Route::post('/schools', [ManagerController::class, 'storeSchool'])->name('manager.store');
    Route::get('/schools/trashed', [ManagerController::class, 'trashedSchools'])->name('manager.trashed');
    Route::delete('/schools/{school}/forcedelete', [ManagerController::class, 'forceDeleteSchool'])->name('manager.forceDelete');
    Route::delete('/schools/{school}', [ManagerController::class, 'deleteSchool'])->name('manager.delete');

    Route::get('/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/create', [AdminController::class, 'store'])->name('admin.store');

    // Route::resource('provaroute', ManagerController::class)
});

