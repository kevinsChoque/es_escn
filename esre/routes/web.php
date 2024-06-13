<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\SolicitudController;
use App\Http\Controllers\BuscadorController;
use App\Http\Controllers\FormatoSolicitudController;
use App\Http\Controllers\ActaController;
use App\Http\Controllers\ActaArchivoController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[InicioController::class, 'actBienvenida']);
// solicitud de reclamos
Route::get('solicitud/solicitud',[SolicitudController::class, 'actSolicitud']);
Route::get('solicitud/registrar',[SolicitudController::class, 'actRegistrar']);
Route::get('solicitud/guardar',[SolicitudController::class, 'actGuardar']);
Route::get('solicitud/listar',[SolicitudController::class, 'actListar']);
// buscar cliente por
Route::get('buscar/bPorInscripcion',[BuscadorController::class, 'actBPorInscripcion']);
// --------------------------formato solicitud o 2
Route::get('formatoSolicitud/mostrar/{idSol}',[FormatoSolicitudController::class, 'actMostrar']);

Route::get('solicitud/ver', function () {
    return view('solicitud/ver');
});

// actas de inspeccion interna y externa
Route::get('acta/acta',[ActaController::class, 'actActa']);
// --------------archivos actas

Route::get('actaArchivo/inspeccionInterna/{idSol}',[ActaArchivoController::class, 'actInspeccionInterna']);
Route::get('actaArchivo/inspeccionExterna/{idSol}',[ActaArchivoController::class, 'actInspeccionExterna']);



