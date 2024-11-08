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
    Route::get('/articoli/crea', [ItemController::class, 'create'])->name('item.create');
    Route::post('/articoli/aggiungi', [ItemController::class, 'store'])->name('item.store');
    Route::get('/articoli/eliminati', [ItemController::class, 'trashed'])->name('item.trashed');
    Route::patch('/articoli/{id}/ripristina', [ItemController::class, 'restore'])->name('item.restore');
    Route::delete('/articoli/{id}/distruggi', [ItemController::class, 'destroy'])->name('item.destroy');
    Route::get('/articoli/{id}/modifica', [ItemController::class, 'edit'])->name('item.edit');
    Route::put('/articoli/{id}/aggiorna', [ItemController::class, 'update'])->name('item.update');
    Route::delete('/articoli/{id}/elimina', [ItemController::class, 'delete'])->name('item.delete');
    Route::get('/articoli/{id}', [ItemController::class, 'show'])->name('item.show');
    // # Categories
    Route::get('/categorie/crea', [CategoryController::class, 'create'])->name('category.create');
    Route::post('/categorie/aggiungi', [CategoryController::class, 'store'])->name('category.store');
    // # Hours
    Route::get('/orari',[HourController::class, 'index'])->name('hour.index');
    Route::get('/orari/crea',[HourController::class, 'create'])->name('hour.create');
    Route::post('/orari/aggiungi', [HourController::class, 'store'])->name('hour.store');
    Route::get('/orari/{id}/modifica',[HourController::class, 'edit'])->name('hour.edit');
    Route::put('/orari/{id}/aggiorna',[HourController::class, 'update'])->name('hour.update');
    Route::delete('/orari/{id}/elimina',[HourController::class, 'delete'])->name('hour.delete');
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
