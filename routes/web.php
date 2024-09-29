<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

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
//Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::resource("/event", EventController::class);

//Route::get('/events', [EventController::class, 'index'])->name('events.index');
//Route::resource("/event", EventController::class)->name('events');
//Route::get('/event', [EventController::class, 'index'])->name('event');

