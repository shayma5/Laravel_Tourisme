<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipatioEventController; 
use App\Http\Controllers\FullEventCalendarController; 
use App\Models\Events;
use App\Http\Controllers\PayementStripeController;
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

Route::get('/hotels', function () {
    return view('backoffice.hotels');
})->name('hotels');

Route::resource("/event", EventController::class);
Route::resource("/participation", ParticipatioEventController::class);
Route::get('/events', [EventController::class, 'indexFrontOffice'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'showFrontOffice'])->name('events.show');
// Route pour la réservation
Route::post('/events/{event}/reserve', [ParticipatioEventController::class, 'reserve'])->name('events.reserve');
// Route pour les participations
Route::get('/events/{event}/participants', [EventController::class, 'showParticipants'])->name('events.participants');
// Route::post('/process-payment', [PayementStripeController::class, 'handlePayment'])->name('process.payment');
// Route::get('/payment/{id}', [PayementStripeController::class, 'handlePayment'])->name('payment');
// pour le paiement
// Route::get('/payment/{id}', [PayementStripeController::class, 'showPaymentPage'])->name('payment');
Route::post('/process-payment', [PayementStripeController::class, 'handlePayment'])->name('process.payment');
Route::get('/payment/{id}', [PayementStripeController::class, 'showPaymentPage'])->name('payment');
Route::match(['get', 'post'], '/events/payement/confirm', [PayementStripeController::class, 'handlePost'])->name('layouts.events.payement.confirm');

Route::get('/evenements', [FullEventCalendarController::class, 'loadEvents']);

Route::get('/calendar', function () {
    return view('backoffice.events.fullcalendar');
})->middleware('auth');
