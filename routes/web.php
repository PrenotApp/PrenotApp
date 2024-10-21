<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Manager\ManagerController as ManagerController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/schools', [ManagerController::class, 'indexSchool'])->name('manager.index');
    Route::post('/schools', [ManagerController::class, 'storeSchool'])->name('manager.store');

    // Route::get('/schools/create', [ManagerController::class, 'createSchool'])->name('manager.create');
    // Route::resource('apartments', ManagerController::class)
});

