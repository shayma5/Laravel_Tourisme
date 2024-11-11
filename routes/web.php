<?php

use App\Http\Controllers\MaisonDhauteController;
use App\Http\Controllers\RoomController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/admin/dashboard', function () {
    return view('backoffice.dashboard');
})->middleware('auth');





//Route::resource('rooms', RoomController::class)->names(['index' => 'backoffice.room.rooms']);

// Backoffice routes
Route::prefix('backoffice')->name('backoffice.')->group(function () {
    // Separate index and show routes for backoffice
    Route::get('maisons', [MaisonDhauteController::class, 'backofficeIndex'])->name('maisons.index');
    Route::get('maisons/create', [MaisonDhauteController::class, 'create'])->name('maisons.create');
    Route::post('maisons', [MaisonDhauteController::class,'store'])->name('maisons.store');
    Route::get('maisons/{id}', [MaisonDhauteController::class, 'backofficeShow'])->name('maisons.show');
    Route::delete('maisons/{id}', [MaisonDhauteController::class, 'destroy'])->name('maisons.destroy');
    Route::get('maisons/{id}/edit', [MaisonDhauteController::class, 'edit'])->name('maisons.edit');
    Route::patch('maisons/{id}', [MaisonDhauteController::class, 'update'])->name('maisons.update');


    // Room routes
    Route::get('rooms', [RoomController::class, 'index'])->name('room.index');
    Route::get('rooms/{id}/edit', [RoomController::class, 'edit'])->name('room.edit');
    Route::patch('rooms/{id}', [RoomController::class, 'update'])->name('room.update');
    Route::delete('rooms/{id}', [RoomController::class, 'destroy'])->name('room.destroy');
    Route::get('rooms/create', [RoomController::class, 'create'])->name('room.create');
    Route::post('rooms', [RoomController::class,'store'])->name('room.store');

});

// Frontoffice routes
Route::prefix('maisondhote')->group(function () {
    // Separate index and show routes for frontoffice
    Route::get('/', [MaisonDhauteController::class, 'frontofficeIndex'])->name('maisondhote.index');
    Route::get('/{id}', [MaisonDhauteController::class, 'frontofficeShow'])->name('maisondhote.show');
});



Route::delete('/backoffice/bookings/{id}', [BookingController::class, 'destroy'])->name('bookings.destroy');
Route::get('/bookings', [BookingController::class, 'index'])->name('bookings.index');
Route::get('/booking/{roomId}', [BookingController::class, 'create'])->name('bookings.create');
Route::post('/maisondhote', [BookingController::class, 'store'])->name('bookings.store');
