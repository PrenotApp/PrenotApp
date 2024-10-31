<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Manager\ManagerController as ManagerController;
use App\Http\Controllers\Manager\VerificationController as VerificationController;
use App\Http\Controllers\Admin\ApprovedController as ApprovedController;
use App\Http\Controllers\Admin\ItemController as ItemController;
use App\Http\Controllers\Admin\CategoryController as CategoryController;
use App\Http\Controllers\Admin\HourController as HourController;
use App\Http\Controllers\Admin\BookingController as BookingController;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controllers\Middleware as ControllersMiddleware;
use GuzzleHttp\Middleware;
use Illuminate\Database\Capsule\Manager;

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

Auth::routes(['verify' => true]);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    // # Manager
    Route::get('/schools', [ManagerController::class, 'indexSchool'])->name('manager.index');
    Route::post('/school/store', [ManagerController::class, 'storeSchool'])->name('manager.store');
    Route::get('/schools/trashed', [ManagerController::class, 'trashedSchools'])->name('manager.trashed');
    Route::delete('/schools/{school}/forcedelete', [ManagerController::class, 'forceDeleteSchool'])->name('manager.forceDelete');
    Route::delete('/schools/{school}/delete', [ManagerController::class, 'deleteSchool'])->name('manager.delete');
    Route::patch('/schools/{school}/restore',[ManagerController::class, 'restore'])->name('manager.restore');
    // # Items
    Route::get('/item/create', [ItemController::class, 'create'])->name('item.create');
    Route::post('/item/store', [ItemController::class, 'store'])->name('item.store');
    Route::get('/item/{id}', [ItemController::class, 'show'])->name('item.show');
    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/item/{id}/update', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/item/{id}/delete', [ItemController::class, 'delete'])->name('item.delete');
    // # Categories
    Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/category/create', [CategoryController::class, 'store'])->name('category.store');
    // # Hours
    Route::get('/time',[HourController::class, 'index'])->name('hour.index');
    Route::get('/time/create',[HourController::class, 'create'])->name('hour.create');
    Route::post('/time/store', [HourController::class, 'store'])->name('hour.store');
    Route::get('/time/{id}/edit',[HourController::class, 'edit'])->name('hour.edit');
    Route::put('/time/{id}/update',[HourController::class, 'update'])->name('hour.update');
    Route::delete('/time/{id}/delete',[HourController::class, 'delete'])->name('hour.delete');
    // # Bookings
    Route::get('bookings',[BookingController::class, 'index'])->name('booking.index');
    Route::get('/bookings/filter', [BookingController::class, 'filter'])->name('booking.filter');
    Route::get('bookings/create',[BookingController::class, 'create'])->name('booking.create');
    Route::post('bookings/store',[BookingController::class, 'store'])->name('booking.store');
    Route::get('/bookings/availablehours', [BookingController::class, 'getAvailableHours'])->name('getAvailableHours');
    Route::delete('/bookings/{id}/delete', [BookingController::class, 'delete'])->name('booking.delete');
    // # Approveds
    Route::get('/teachers',[ApprovedController::class, 'index'])->name('approved.index');
    Route::post('/teachers/store',[ApprovedController::class, 'store'])->name('approved.store');
    Route::delete('/teachers/{approved}/delete',[ApprovedController::class, 'delete'])->name('approved.delete');
    Route::get('/teachers/trashed',[ApprovedController::class, 'trashed'])->name('approved.trashed');
    Route::patch('/teachers/{approved}/restore',[ApprovedController::class, 'restore'])->name('approved.restore');
    Route::delete('/teachers/{approved}/forcedelete',[ApprovedController::class, 'forceDelete'])->name('approved.forceDelete');
    // # Mail
    // Route::resource('provaroute', ManagerController::class);

});
