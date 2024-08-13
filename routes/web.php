<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Bus_stopController;
use App\Http\Controllers\UserController;
use Database\Factories\UserFactory;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
  Route::controller(Bus_stopController::class)->group(function(){
    Route::get('/', 'index')->name('bus-stops.index');
    Route::get('/bus-stops/admin', 'edit')->name('bus-stop.admin');
    Route::post('/bus-stops', 'store');

  });
  
  Route::controller(UserController::class)->group(function(){
    Route::get('/login', 'login')->name('login');
    Route::get('/register', 'register')->name('register');
    Route::post('dashboard', 'dashboard')->name('dashboard');
  });


