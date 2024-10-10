<?php

use App\Http\Controllers\MaisonDhauteController;
use App\Http\Controllers\RoomController;
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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::get('/admin/dashboard', function () {
    return view('backoffice.dashboard');
})->middleware('auth');





Route::resource('rooms', RoomController::class)->names(['index' => 'backoffice.room.rooms']);

Route::group(['prefix' => 'backoffice', 'as' => 'backoffice.'], function() {
    Route::resource('room', RoomController::class);
});

Route::resource('maisons', MaisonDhauteController::class)->names([
    'index' => 'backoffice.maisons'
]);

Route::resource('maisondhote', MaisonDhauteController::class);


