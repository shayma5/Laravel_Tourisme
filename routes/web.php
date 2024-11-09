<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampagnePromotionnelleController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\MagasinController;
use App\Http\Controllers\SouvenirController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\LoadingController;

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





// Routes Gestion des Promotions et Souvenirs
Route::resource('/campagnes', CampagnePromotionnelleController::class);
Route::resource('/promotions', PromotionController::class);
Route::resource('/magasins', MagasinController::class);
Route::resource('/souvenirs', SouvenirController::class);
Route::post('/magasins/{magasin}/souvenirs/{souvenir}/unassign', [MagasinController::class, 'unassignSouvenir'])->name('magasins.souvenirs.unassign');
Route::put('/magasins/{magasin}/souvenirs/unassign-multiple', [MagasinController::class, 'unassignMultiple'])
    ->name('magasins.souvenirs.unassign-multiple');
Route::put('/magasins/{magasin}/souvenirs', [MagasinController::class, 'updateSouvenirs'])
    ->name('magasins.souvenirs.update');
Route::get('/loading', [LoadingController::class, 'show'])->name('loading');
Route::post('/loading/store', [LoadingController::class, 'store'])->name('loading.store');
Route::get('home/magasins/{magasin}/souvenirs', [SouvenirController::class, 'souvenirsParMagasin'])->name('layouts.SouvenirsArtisanat.magasins.indexSouvenirMagasin');
Route::get('/home/magasins', [MagasinController::class, 'publicIndex'])->name('layouts.SouvenirsArtisanat.magasins.index');
Route::get('/home/magasins/{magasin}', [MagasinController::class, 'showPublic'])->name('layouts.SouvenirsArtisanat.magasins.show');
Route::get('/home/souvenirs', [SouvenirController::class, 'publicIndex'])->name('layouts.SouvenirsArtisanat.souvenirs.index');
Route::get('/home/souvenirs/{souvenir}', [SouvenirController::class, 'showPublic'])->name('layouts.SouvenirsArtisanat.souvenirs.show');
Route::get('/home/stripe-payment/{id}', [SouvenirController::class, 'payment'])->name('layouts.SouvenirsArtisanat.souvenirs.payment.payment');
Route::post('/home/stripe-payment', [StripePaymentController::class, 'handlePost'])->name('layouts.SouvenirsArtisanat.souvenirs.payment.confirm');
Route::get('/home/thank-you', function () {
    return view('layouts.SouvenirsArtisanat.souvenirs.payment.thankyou');
})->name('layouts.SouvenirsArtisanat.souvenirs.payment.thankyou');




Route::get('/api/magasins/without-promotions', function() {
    return \App\Models\Magasin::doesntHave('promotions')->get(['id', 'nomMagasin']);
});

Route::get('/api/magasins/without-souvenirs', function() {
    return \App\Models\Magasin::doesntHave('souvenirs')->get(['id', 'nomMagasin']);
});







