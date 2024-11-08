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
use App\Http\Controllers\Admin\RackController as RackController;
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

Route::middleware(['auth','verified'])->group(function () {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    // # Manager
    Route::get('/scuole', [ManagerController::class, 'indexSchool'])->name('manager.index');
    Route::post('/scuole/aggiungi', [ManagerController::class, 'storeSchool'])->name('manager.store');
    Route::get('/scuole/cestino', [ManagerController::class, 'trashedSchools'])->name('manager.trashed');
    Route::delete('/scuole/{school}/forzaeliminazione', [ManagerController::class, 'forceDeleteSchool'])->name('manager.forceDelete');
    Route::delete('/scuole/{school}/elimina', [ManagerController::class, 'deleteSchool'])->name('manager.delete');
    Route::patch('/scuole/{school}/ripristina',[ManagerController::class, 'restore'])->name('manager.restore');
    // # Items
    Route::get('/dispositivo/crea', [ItemController::class, 'create'])->name('item.create');
    Route::post('/dispositivo/aggiungi', [ItemController::class, 'store'])->name('item.store');
    Route::get('/dispositivo/{id}', [ItemController::class, 'show'])->name('item.show');
    Route::get('/dispositivo/{id}/modifica', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/dispositivo/{id}/aggiorna', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/dispositivo/{id}/elimina', [ItemController::class, 'delete'])->name('item.delete');
    // # Categories
    Route::get('/categoria/crea', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categoria/aggiungi', [CategoryController::class, 'store'])->name('category.store');
    // # Hours
    Route::get('/orario',[HourController::class, 'index'])->name('hour.index');
    Route::post('/orario/aggiungi', [HourController::class, 'store'])->name('hour.store');
    Route::get('/orario/{id}/modifica',[HourController::class, 'edit'])->name('hour.edit');
    Route::put('/orario/{id}/aggiorna',[HourController::class, 'update'])->name('hour.update');
    Route::delete('/orario/{id}/elimina',[HourController::class, 'delete'])->name('hour.delete');
    // # Bookings
    Route::get('prenotazioni',[BookingController::class, 'index'])->name('booking.index');
    Route::get('/prenotazioni/filtri', [BookingController::class, 'filter'])->name('booking.filter');
    Route::get('prenotazioni/{id}/crea',[BookingController::class, 'create'])->name('booking.create');
    Route::post('prenotazioni/{id}/aggiungi',[BookingController::class, 'store'])->name('booking.store');
    Route::get('/prenotazioni/oredisponibili', [BookingController::class, 'getAvailableHours'])->name('getAvailableHours');
    Route::delete('/prenotazioni/{id}/elimina', [BookingController::class, 'delete'])->name('booking.delete');
    // # Approveds
    Route::get('/docenti',[ApprovedController::class, 'index'])->name('approved.index');
    Route::post('/docenti/aggiungi',[ApprovedController::class, 'store'])->name('approved.store');
    Route::delete('/docenti/{approved}/elimina',[ApprovedController::class, 'delete'])->name('approved.delete');
    Route::get('/docenti/cestino',[ApprovedController::class, 'trashed'])->name('approved.trashed');
    Route::patch('/docenti/{approved}/ripristina',[ApprovedController::class, 'restore'])->name('approved.restore');
    Route::delete('/docenti/{approved}/forzaeliminazione',[ApprovedController::class, 'forceDelete'])->name('approved.forceDelete');
    // # Racks
    Route::get('/gruppi/crea',[RackController::class, 'create'])->name('rack.create');
    Route::post('/gruppi/crea',[RackController::class, 'store'])->name('rack.store');
    Route::get('/gruppi/{gruppo}/modifica',[RackController::class, 'edit'])->name('rack.edit');
    Route::put('/gruppi/{gruppo}/aggiorna',[RackController::class, 'update'])->name('rack.update');
    Route::get('/gruppi/{gruppo}/prenota',[RackController::class, 'booking'])->name('rack.booking');
    Route::get('/gruppi/disponibili', [RackController::class, 'getAvailableItems'])->name('rack.available');
    Route::post('/gruppi/{gruppo}/prenota',[RackController::class, 'bookAvailable'])->name('rack.book');
    // # Mail
    // Route::resource('provaroute', ManagerController::class);
});
