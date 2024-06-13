<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StartController;
use App\Http\Controllers\CourtController;
use App\Http\Controllers\TecnicalController;
use App\Http\Controllers\EvidenceController;
use App\Http\Controllers\EndingController;
use App\Http\Controllers\ReportController;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/',[StartController::class, 'actLogin']);
// login
Route::post('login/sigin',[LoginController::class, 'actSigin'])->name('login');
// cortes
// Route::get('/',[StartController::class, 'actStart']);
Route::get('court/start',[CourtController::class, 'actStart'])->name('home');
Route::get('court/showCourtFilter',[CourtController::class, 'actShowCourtFilter']);
Route::post('court/searchRecords',[CourtController::class, 'actSearchRecords'])->name('searchRecords');
Route::get('court/courtAssign',[CourtController::class, 'actCourtAssign'])->name('listCourtAssign');

// tecnical

Route::get('tecnical/list',[TecnicalController::class, 'actList'])->name('tecnicalList');
Route::post('tecnical/assign',[TecnicalController::class, 'actAssign'])->name('assignTecnical');
Route::post('tecnical/courtUser',[TecnicalController::class, 'actCourtUser'])->name('courtUser');
Route::post('tecnical/activateUser',[TecnicalController::class, 'actActivateUser'])->name('activateUser');
Route::get('tecnical/showAssignTecnical',[TecnicalController::class, 'actShowAssignTecnical'])->name('showAssignTecnical');
// evidence

Route::post('evidence/sendEvidence',[EvidenceController::class, 'actSendEvidence'])->name('sendEvidence');
Route::post('evidence/showEvidences',[EvidenceController::class, 'actShowEvidences'])->name('showEvidences');
Route::post('evidence/deleteEvidence',[EvidenceController::class, 'actDeleteEvidence'])->name('deleteEvidence');
// fecha de finalizacion de los cortes y rehabilitacion

Route::post('ending/searchEnding',[EndingController::class, 'actSearchEnding'])->name('searchEnding');
Route::post('ending/saveEnding',[EndingController::class, 'actSaveEnding'])->name('saveEnding');
Route::post('ending/updateEnding',[EndingController::class, 'actUpdateEnding'])->name('updateEnding');
Route::post('ending/saveChangeEnding',[EndingController::class, 'actSaveChangeEnding'])->name('saveChangeEnding');
// reportes

Route::get('report/showReport',[ReportController::class, 'actShowReport'])->name('showReport');





