<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bus_stopController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LineController;

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

Route::get('/dou', function () {
    return view('welcome');
});

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
  Route::post('/bus-stops', 'store')->name('bus-stops.store');
  Route::post('/bus-stops/admin/edit', 'editar')->name('bus-stops.edit');
  Route::post('/bus-stops/admin/storeroutes', 'storeroutes')->name('bus-stops.storeroutes');
});

//Route::middleware('solo.admin')->group(function (){
    Route::get('/bus-stops/admin', [Bus_stopController::class, 'edit'])->name('bus-stop.admin');
    Route::get('/bus-stops/admin/eliminar/{id}', [Bus_stopController::class, 'eliminar'])->name('bus-stops.eliminar');
    //Route::get('/bus-stops/admin/routes/eliminar/{road_group}', 'eliminarRutas')->name('bus-stops.routes.eliminar');
    Route::get('/bus-stops/admin/editar/{id}', [Bus_stopController::class, 'edite'])->name('bus-stops.editar');
    Route::get('/bus-stops/admin/routes', [Bus_stopController::class, 'routes'])->name('bus-stops.routes');
    Route::get('/Lines/admin', [LineController::class, 'Admin'])->name('LinesAdmin');
    Route::post('/Lines/admin/Company/update', [LineController::class, 'añadircompany'])->name('companyupdate');
    Route::post('/Lines/admin/update', [LineController::class, 'añadirlinea'])->name('lineaupdate');
    Route::post('/Lines/admin/line_has_stops/update', [LineController::class, 'añadirrelacion'])->name('relacion');
    Route::get('/Lines/admin/Company/edit', [LineController::class, 'editarCompania'])->name('companyedit');
    Route::get('/Lines/admin/Company/edit/linea/{id}', [LineController::class, 'editarlinea'])->name('lineaedit');
    Route::get('/Lines/admin/Company/edit/compania/{id}', [LineController::class, 'Ceditar'])->name('Cedit');
//});

Route::controller(LineController::class)->group(function(){
    Route::get('/Lines', 'Lines')->name('LinesView');
    Route::get('/Lines/buscar/{id}', 'LinesBusc')->name('LineBusc');
});

Route::get('/menu', [MenuController::class, 'showMenu']);

Route::get('/pruebamail', [MailController::class, 'enviarCorreoPrueba']);

require __DIR__.'/auth.php';
