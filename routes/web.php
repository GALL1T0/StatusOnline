<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReparacionController;
use App\Http\Controllers\SessionsController;
use GuzzleHttp\Middleware;

Route::get('/', function () {return redirect('sign-in');})->middleware('guest');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');
Route::get('sign-up', [RegisterController::class, 'create'])->middleware('guest')->name('register');
Route::post('sign-up', [RegisterController::class, 'store'])->middleware('guest');
Route::get('sign-in', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sign-in', [SessionsController::class, 'store'])->middleware('guest');
Route::post('verify', [SessionsController::class, 'show'])->middleware('guest');
Route::post('reset-password', [SessionsController::class, 'update'])->middleware('guest')->name('password.update');
Route::get('verify', function () {
	return view('sessions.password.verify');
})->middleware('guest')->name('verify');
Route::get('/reset-password/{token}', function ($token) {
	return view('sessions.password.reset', ['token' => $token]);
})->middleware('guest')->name('password.reset');

Route::post('sign-out', [SessionsController::class, 'destroy'])->middleware('auth')->name('logout');
Route::get('profile', [ProfileController::class, 'create'])->middleware('auth')->name('profile');
Route::post('user-profile', [ProfileController::class, 'update'])->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('billing', function () {
		return view('pages.billing');
	})->name('billing');
	Route::get('tables', function () {
		return view('pages.tables');
	})->name('tables');
	Route::get('rtl', function () {
		return view('pages.rtl');
	})->name('rtl');
	Route::get('virtual-reality', function () {
		return view('pages.virtual-reality');
	})->name('virtual-reality');
	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');
	Route::get('static-sign-in', function () {
		return view('pages.static-sign-in');
	})->name('static-sign-in');
	Route::get('static-sign-up', function () {
		return view('pages.static-sign-up');
	})->name('static-sign-up');
	Route::get('user-management', function () {
		return view('pages.laravel-examples.user-management');
	})->name('user-management');
	Route::get('user-profile', function () {
		return view('pages.laravel-examples.user-profile');
	})->name('user-profile');


    //Reparaciones
    Route::get('/nuevaReparacion',[ReparacionController::class, 'vistaNuevaReparacion'])->middleware('auth')->name('nuevaReparacionVista');
    Route::post('/guardarReparacion', [ReparacionController::class , 'guardarReparacion'])->middleware('auth')->name('guardarReparacion');
    Route::get('/nuevoProducto', [ReparacionController::class,'vistaNuevoProducto'])->middleware('auth')->name('nuevoProductoVista');
    Route::post('/guardarProducto', [ReparacionController::class, 'guardarProducto'])->middleware('auth')->name('guardarProducto');
    Route::get('/reparacionesPendientes',[ReparacionController::class,'reparacionesPendientes'])->middleware('auth')->name('verReparacionesPendientes');
    Route::post('/updateReparacion',[ReparacionController::class, 'updateReparacionPendiente'])->middleware('auth')->name('updateReparacionesPendientes');
    Route::get('/modificarReparacion/{id}',[ReparacionController::class, 'modificarReparacion'])->middleware('auth')->name('modificarReparacion');
    Route::get('/eliminar/{id}', [ReparacionController::class, 'eliminarReparacion'])->middleware('auth')->name('eliminarReparacion');
});

Route::get('/buscarReparacion',[ReparacionController::class, 'consultaReparacion'])->name('consultarReparacion');
Route::post('/buscarReparacion', [ReparacionController::class, 'consultarReparacionByUUID'])->name('consultarReparacionByUUID');

