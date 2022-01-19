<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

//Route Hooks - Do not delete//
	Route::view('inscripciones', 'livewire.inscripciones.index')->middleware('auth');
	Route::view('maestro_ofertas', 'livewire.maestroOfertas.index')->middleware('auth');
	Route::view('aulas', 'livewire.aulas.index')->middleware('auth');
	Route::view('modulos', 'livewire.modulos.index')->middleware('auth');
	Route::view('horarios', 'livewire.horarios.index')->middleware('auth');
	Route::view('docentes', 'livewire.docentes.index')->middleware('auth');
	Route::view('estudiantes', 'livewire.estudiantes.index')->middleware('auth');
	Route::view('materias', 'livewire.materias.index')->middleware('auth');
	Route::view('grupos', 'livewire.grupos.index')->middleware('auth');
	Route::view('gestiones', 'livewire.gestiones.index')->middleware('auth');
	Route::view('cuentas', 'livewire.cuentas.index')->middleware('auth');
	Route::view('clientes', 'livewire.clientes.index')->middleware('auth');