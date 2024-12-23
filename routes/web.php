<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bus_stopController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LineController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LocalizacionController;


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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(Bus_stopController::class)->group(function(){
  Route::get('/', 'index')->name('bus-stops.index');
});

Route::middleware('solo.admin')->group(function (){
    Route::post('/bus-stops', [Bus_stopController::class,'store'])->name('bus-stops.store');
    Route::post('/bus-stops/admin/edit',[Bus_stopController::class,'editar'])->name('bus-stops.edit');
    Route::post('/bus-stops/admin/storeroutes',[Bus_stopController::class,'storeroutes'])->name('bus-stops.storeroutes');
    Route::get('/bus-stops/admin', [Bus_stopController::class, 'edit'])->name('bus-stop.admin');
    Route::get('/bus-stops/admin/eliminar/{id}', [Bus_stopController::class, 'eliminar'])->name('bus-stops.eliminar');
    Route::get('/bus-stops/admin/routes/eliminar/{road_group}', [Bus_stopController::class,'eliminarRutas'])->name('bus-stops.routes.eliminar');
    Route::get('/bus-stops/admin/editar/{id}', [Bus_stopController::class, 'edite'])->name('bus-stops.editar');
    Route::get('/bus-stops/admin/routes', [Bus_stopController::class, 'routes'])->name('bus-stops.routes');
    Route::get('/Lines/admin', [LineController::class, 'Admin'])->name('LinesAdmin');
    Route::post('/Lines/admin/Company/update', [LineController::class, 'añadircompany'])->name('companyupdate');
    Route::post('/Lines/admin/update', [LineController::class, 'añadirlinea'])->name('lineaupdate');
    Route::post('/Lines/admin/line_has_stops/update', [LineController::class, 'añadirrelacion'])->name('relacion');
    Route::post('/Lines/admin/line_has_stops/update1a1', [LineController::class, 'añadirrelacion1a1'])->name('relacion1a1');
    Route::get('/Lines/admin/Company/options', [LineController::class, 'editarCompania'])->name('companyedit');
    Route::get('/Lines/admin/Company/options/edit/linea/{id}', [LineController::class, 'editarlinea'])->name('lineaedit');
    Route::get('/Lines/admin/Company/options/edit/compania/{id}', [LineController::class, 'Ceditar'])->name('Cedit');
    Route::post('/Lines/admin/Company/options/compania/Cenviar', [LineController::class, 'Cenviar'])->name('Cenviar');
    Route::post('/Lines/admin/Company/options/linea/Lenviar', [LineController::class, 'Lenviar'])->name('Lenviar');
    Route::post('/Lines/admin/Company/options/linea/eliminar', [LineController::class, 'EliminarStop'])->name('EliminarStop');
    Route::get('/Lines/admin/Company/options/eliminar/linea/{id}', [LineController::class, 'Eliminarlinea'])->name('Eliminarlinea');
    Route::get('/Lines/admin/Company/options/eliminar/compania/{id}', [LineController::class, 'Eliminarcompania'])->name('Eliminarcompania');
});

Route::controller(LineController::class)->group(function(){
    Route::get('/Lines', 'Lines')->name('LinesView');
    Route::get('/Lines/buscar/{id}', 'LinesBusc')->name('LineBusc');
});


Route::controller(UserController::class)->group(function(){
    Route::get("/dashboard/users","listadoUsuarios")->middleware("solo.admin")->name("dashboard.users");
    Route::get("/dashboard/users/manage/{id}","getUserInfo")->middleware("solo.admin")->name("users.manage");
    Route::put("/dasboard/users/manage/{id}/post","cambiarRol")->name("users.manage.post");
    Route::get('/dashboard','dashboard')->middleware(['auth', 'verified'])->name('dashboard');
    Route::post('/store/stop','guardarParada')->name('user-stop.store');
    Route::delete('/delete/{id}','eliminarParada')->name('bus-stop.delete');
    Route::post('/dashboard/users/manage/lines','RelacionarLinea')->name('user-line.add');
});

Route::middleware('solo.colectivero')->group(function (){
    Route::get('/locate',[LocalizacionController::class, 'show'])->name('locate');
    Route::post('/location', [LocalizacionController::class, 'store']);
});

Route::get('/menu', [MenuController::class, 'showMenu']);

Route::get('/pruebamail', [MailController::class, 'enviarCorreoPrueba']);

require __DIR__.'/auth.php';

