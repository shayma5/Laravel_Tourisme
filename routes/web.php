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

// Route::get('/restaurants',[RestaurantController::class, 'app'] ,function () {
//     return view('app.restaurants.index');
// })->name('restaurants.index2');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Routes backend (admin)

Route::resource('plats', PlatController::class);
Route::resource('avis', AvisController::class);


// Routes frontend (utilisateurs)
Route::get('/restaurants/frontend', [RestaurantController::class, 'showFrontend'])->name('restaurants.showFrontend');
Route::get('/restaurants/frontend/{id}', [RestaurantController::class, 'showFrontend'])->name('restaurants.show.frontend');
Route::get('/restaurants/app', [RestaurantController::class, 'app'])->name('restaurants.app');

Route::prefix('admin')->group(function () {
    Route::resource('restaurants', RestaurantController::class);
});




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
