<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bus_stopController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(Bus_stopController::class)->group(function(){
  Route::get('/', 'index')->name('bus-stops.index');
  Route::get('/bus-stops/admin', 'edit')->name('bus-stop.admin');
  Route::post('/bus-stops', 'store')->name('bus-stops.store');
  Route::get('/bus-stops/admin/eliminar/{id}', 'eliminar')->name('bus-stops.eliminar');
  Route::get('/bus-stops/admin/editar/{id}', 'edite')->name('bus-stops.editar');
  Route::post('/bus-stops/admin/edit', 'editar')->name('bus-stops.edit');

});

Route::get('/menu', [MenuController::class, 'showMenu']);

Route::get('/pruebamail', [MailController::class, 'enviarCorreoPrueba']);

require __DIR__.'/auth.php';
