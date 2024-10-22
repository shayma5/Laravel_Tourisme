<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgrammeController;
use App\Http\Controllers\FormationController;
use App\Http\Controllers\ClasseController;
use App\Http\Controllers\FormateurController;
use App\Http\Controllers\ReservationController;


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


Route::get('/admin/dashboard/formateurs', [App\Http\Controllers\FormateurController::class, 'index']);
Route::get('/admin/dashboard/formateurs/createformateur', [App\Http\Controllers\FormateurController::class, 'createformateur']);
Route::post('/admin/dashboard/formateurs/createformateur',[App\Http\Controllers\FormateurController::class, 'storeformateur']);
Route::get('/admin/dashboard/formateurs/{id}/editformateur', [App\Http\Controllers\FormateurController::class, 'editformateur']);
Route::put('admin/dashboard/formateurs/{id}/editformateur', [App\Http\Controllers\FormateurController::class, 'updateformateur']);
Route::get('/admin/dashboard/formateurs/{id}/deleteformateur', [App\Http\Controllers\FormateurController::class, 'deleteformateur']);


Route::get('/admin/dashboard/formations', [App\Http\Controllers\FormationController::class, 'indexformation']);
Route::get('/admin/dashboard/formations/createformation', [App\Http\Controllers\FormationController::class, 'createformation']);
Route::post('/admin/dashboard/formations/createformation', [FormationController::class, 'storeformation'])->name('formations.store');
Route::get('/admin/dashboard/formations/{id}/editformation', [App\Http\Controllers\FormationController::class, 'editformation']);
Route::put('admin/dashboard/formations/{id}/editformation', [App\Http\Controllers\FormationController::class, 'updateformation']);
Route::get('/admin/dashboard/formations/{id}/deleteformation', [App\Http\Controllers\FormationController::class, 'deleteformation']);
Route::delete('/admin/dashboard/formations/{id}/deleteformation', [FormationController::class, 'deleteformation'])->name('formations.delete');
Route::post('/admin/dashboard/formations/{id}/editformation', [FormationController::class, 'updateformation'])->name('formations.edit');


Route::resource('/admin/dashboard/programmes',ProgrammeController::class);
Route::get('admin/dashboard/formations/{formation}/affecter', [ProgrammeController::class, 'affecter'])->name('formations.affecter');
Route::post('admin/dashboard/formations/{formation}/affecter', [ProgrammeController::class, 'storeAffectation'])->name('formations.affecter.store');
// Dans routes/web.php
Route::get('/admin/dashboard/formations', [FormationController::class, 'indexformation'])->name('formations.index');
Route::get('/programmes/{programme}', [ProgrammeController::class, 'show'])->name('programmes.show');


Route::get('/admin/dashboard/classes', [App\Http\Controllers\ClasseController::class, 'indexclasse']);
Route::get('/admin/dashboard/classes/createclasse', [App\Http\Controllers\ClasseController::class, 'createclasse']);
Route::post('/admin/dashboard/classes/createclasse', [ClasseController::class, 'storeclasse'])->name('classes.store');
Route::get('/admin/dashboard/classes/{id}/editclasse', [App\Http\Controllers\ClasseController::class, 'editclasse']);
Route::put('admin/dashboard/classes/{id}/editclasse', [App\Http\Controllers\ClasseController::class, 'updateclasse']);
Route::get('/admin/dashboard/classes/{id}/deleteclasse', [App\Http\Controllers\ClasseController::class, 'deleteclasse']);
Route::delete('/admin/dashboard/classes/{id}/deleteclasse', [ClasseController::class, 'deleteclasse'])->name('classes.delete');
Route::post('/admin/dashboard/classes/{id}/editclasse', [ClasseController::class, 'updateclasse'])->name('classes.edit');


Route::get('admin/dashboard/classes/{classe}/affecterCP', [FormateurController::class, 'affecterCP'])->name('classes.affecter');
Route::post('admin/dashboard/classes/{classe}/affecterCP', [FormateurController::class, 'storeAffectationCP'])->name('classes.affecterCF.store');
Route::get('/admin/dashboard/classes', [ClasseController::class, 'indexclasse'])->name('classes.indexclasse');
Route::get('/admin/dashboard/formateurs/{formateur}', [FormateurController::class, 'showCP'])->name('formateurs.showCP');


//Route::resource('reservations', ReservationController::class);
Route::get('/reservations/tout', [ReservationController::class, 'indexFor'])->name('reservations.indexR');
Route::post('/reservations', [ReservationController::class, 'store'])->name('reservations.store');
Route::get('/reservations/Ar', [ReservationController::class, 'index'])->name('reservations.indexA_R');
Route::resource('reservations', ReservationController::class);
Route::get('reservations/create/{formation_id}', [ReservationController::class, 'createe'])->name('reservations.createR');
