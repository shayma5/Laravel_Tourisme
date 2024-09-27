<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\PlatController;
use App\Http\Controllers\AvisController;
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
Route::resource('restaurants', RestaurantController::class);
Route::resource('plats', PlatController::class);
Route::resource('avis', AvisController::class);
Route::get('/restaurants', [RestaurantController::class, 'app'])->name('restaurants.app');
Route::get('/restaurants/frontend/{id}', [RestaurantController::class, 'showFrontend'])->name('restaurants.show.frontend');

// Route pour le front-office



// Route::post('/restaurants', [RestaurantController::class, 'store'])->name('restaurants.store');
// routes/web.php


Route::get('/admin/dashboard', function () {
    return view('backoffice.dashboard');
})->middleware('auth');

Route::get('/hotels', function () {
    return view('backoffice.hotels');
})->name('hotels');

// Route::get('/restaurants', function () {
//     return view('backoffice.restaurants.index'); // Add .index to indicate the file
// })->name('resturants');
