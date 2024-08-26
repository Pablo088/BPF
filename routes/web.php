<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bus_stopController;
use App\Http\Controllers\UserController;
use Database\Factories\UserFactory;
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

  Route::controller(Bus_stopController::class)->group(function(){
    Route::get('/', 'index')->name('bus-stops.index');
    Route::get('/bus-stops/admin', 'edit')->name('bus-stop.admin');
    Route::post('/bus-stops', 'store')->name('bus-stops.store');
    Route::get('/bus-stops/admin/eliminar/{id}', 'eliminar')->name('bus-stops.eliminar');
    Route::get('/bus-stops/admin/editar/{id}', 'edite')->name('bus-stops.editar');
    Route::post('/bus-stops/admin/edit', 'editar')->name('bus-stops.edit');

  });
  
  Route::controller(UserController::class)->group(function(){
    Route::get('login','login')->name('login');
    Route::post('login/validate','validateLogin')->name('login.validate')->middleware('session.auth');
    Route::get('logout','logout')->name('logout');
    Route::get('register', 'register')->name('register');
    Route::post('dashboard', 'storeUser')->name('dashboard');
  });

  Route::get('/menu', [MenuController::class, 'showMenu']);

  


Route::get('/pruebamail', [MailController::class, 'enviarCorreoPrueba']);
