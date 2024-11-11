<?php


use App\Http\Controllers\MaisonDhauteController;
use App\Http\Controllers\RoomController;

use App\Http\Controllers\BookingController;



use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EventController;
use App\Http\Controllers\ParticipatioEventController;
use App\Http\Controllers\FullEventCalendarController;
use App\Models\Events;
use App\Http\Controllers\PayementStripeController;
use App\Http\Controllers\CampagnePromotionnelleController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\MagasinController;
use App\Http\Controllers\SouvenirController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\LoadingController;

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



// route pour module Event
Route::resource("/event", EventController::class);
Route::resource("/participation", ParticipatioEventController::class);
Route::get('/events', [EventController::class, 'indexFrontOffice'])->name('events.index');
Route::get('/events/{id}', [EventController::class, 'showFrontOffice'])->name('events.show');
// Route pour la réservation
Route::post('/events/{event}/reserve', [ParticipatioEventController::class, 'reserve'])->name('events.reserve');
// Route pour les participations
Route::get('/events/{event}/participants', [EventController::class, 'showParticipants'])->name('events.participants');
Route::post('/process-payment', [PayementStripeController::class, 'handlePayment'])->name('process.payment');
Route::get('/payment/{id}', [PayementStripeController::class, 'showPaymentPage'])->name('payment');
Route::match(['get', 'post'], '/events/payement/confirm', [PayementStripeController::class, 'handlePost'])->name('layouts.events.payement.confirm');
Route::get('/evenements', [FullEventCalendarController::class, 'loadEvents']);
Route::get('/calendar', function () {
    return view('backoffice.events.fullcalendar');
})->middleware('auth');


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

// Route::get('/restaurants', function () {
//     return view('backoffice.restaurants.index'); // Add .index to indicate the file
// })->name('resturants');
