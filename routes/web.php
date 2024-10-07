<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CampagnePromotionnelleController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\MagasinController;
use App\Http\Controllers\SouvenirController;


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






Route::resource('/campagnes', CampagnePromotionnelleController::class);

/*
GET /campagnes (index) => campagnes.index
GET /campagnes/create (create)
POST /campagnes (store)
GET /campagnes/{campagne} (show)
GET /campagnes/{campagne}/edit (edit)
PUT/PATCH /campagnes/{campagne} (update)
DELETE /campagnes/{campagne} (destroy)
*/



Route::resource('/promotions', PromotionController::class);


Route::resource('/magasins', MagasinController::class);





Route::resource('/souvenirs', SouvenirController::class);


Route::get('/home/magasins', [MagasinController::class, 'publicIndex'])->name('layouts.SouvenirsArtisanat.magasins.index');