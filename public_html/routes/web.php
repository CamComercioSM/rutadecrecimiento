<?php

use App\Http\Controllers\DiagnosticoController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\RegistroController;
use App\Http\Controllers\ProgramaController;
use Illuminate\Support\Facades\Artisan;
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

Route::get('/', [InicioController::class, 'index'])->name('home');
Route::get('/mapa-sitio', [InicioController::class, 'mapa'])->name('site.map');

/* Rutas de registro */
Route::get('/registro', [RegistroController::class, 'index'])->name('register');
Route::post('/registro/buscar', [RegistroController::class, 'search'])->name('register.search');
Route::post('/registro/actualizar', [RegistroController::class, 'store'])->name('register.save');
Route::post('/registro/lead', [RegistroController::class, 'storeLead'])->name('register.lead');

/* Rutas de empresa */
Route::get('/ingreso', [LoginController::class, 'index'])->name('login');
Route::post('/ingreso/procesar', [LoginController::class, 'login'])->name('login.process');
Route::get('/logout', [LoginController::class, 'logout'])->name('company.logout');

Route::get('/empresa/diagnostico', [DiagnosticoController::class, 'index'])->name('company.diagnostic');
Route::post('/empresa/diagnostico', [DiagnosticoController::class, 'index'])->name('company.diagnostic.saveVenta');
Route::post('/empresa/diagnostico/procesar', [DiagnosticoController::class, 'store'])->name('company.diagnostic.save');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/dashboard', [PerfilController::class, 'dashboard'])->name('company.dashboard');
    Route::get('/seleccionarEmpresa', [PerfilController::class, 'SeleccionarUnidadProductiva'])->name('company.select');

    Route::get('/historialDiagnosticos', [PerfilController::class, 'historialDiagnosticos'])->name('company.historialDiagnosticos');
    Route::get('/historialDiagnosticos/{id}', [PerfilController::class, 'historialDiagnosticoDetalle']);
    Route::get('/exportarPreguntasDiagnostico/{id}', [PerfilController::class, 'exportarPreguntasDiagnostico']);
    
    Route::get('/empresa/actualizar', [PerfilController::class, 'completarInformacion'])->name('company.complete_info');
    Route::post('/empresa/actualizar/guardar', [PerfilController::class, 'completarInformacionGuardar'])->name('company.complete_info.save');
    Route::get('/empresa/perfil', [PerfilController::class, 'perfil'])->name('company.profile');
    Route::get('/empresa/perfil/actualizar', [PerfilController::class, 'actualizarPerfil'])->name('company.profile.update');
    Route::post('/empresa/perfil/guardar', [PerfilController::class, 'actualizarPerfilGuardar'])->name('company.profile.save');
    Route::get('/empresa/password/actualizar', [PerfilController::class, 'actualizarPassword'])->name('company.password.update');
    Route::post('/empresa/password/guardar', [PerfilController::class, 'actualizarPasswordGuardar'])->name('company.password.save');
    
    Route::get('/grafico-radial/{id}', [PerfilController::class, 'grafico'])->name('company.graph.radial');
    Route::get('/empresa/programas', [ProgramaController::class, 'index'])->name('company.programs');
    Route::get('/empresa/programa/{id}', [ProgramaController::class, 'programShow'])->name('company.program.show');
    Route::get('/empresa/programa/registro/{id}', [ProgramaController::class, 'programRegister'])->name('company.program.register');
    Route::get('/empresa/capsulas', [ProgramaController::class, 'capsulas'])->name('company.capsules');
    Route::post('/empresa/aplicacion/procesar', [ProgramaController::class, 'applicationSave'])->name('company.application.save');

    Route::get('/municipios/listado', [InicioController::class, 'getMunicipios'])->name('company.getMunicipios');
    Route::get('/secciones/listado', [InicioController::class, 'getSecciones'])->name('company.getSecciones');
    Route::get('/actividades/listado', [InicioController::class, 'getActividades'])->name('company.getActividades');
});


Route::get('/clear', function(){
    Artisan::call('optimize');
    dump('Optmize done');
});

Route::get('/link', function () { Artisan::call('storage:link'); });
