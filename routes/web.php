<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfController;
use App\Http\Controllers\StudentController;
use PhpOffice\PhpSpreadsheet\Calculation\Statistical\Distributions\StudentT;

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

Route::get('/', [HomeController::class, 'index']);
Auth::routes();

Route::get('/admin', [AdminController::class, 'index'])->name('admin')->middleware('adminaccess');
Route::get('/admin/exports', [AdminController::class, 'exportCandidats'])->name('export-candidats');
Route::post('/admin/imports', [AdminController::class, 'importEtudiants'])->name('import-etudiants');
Route::get('/prof', [ProfController::class, 'index'])->name('prof')->middleware('profaccess');
Route::get('/student', [StudentController::class, 'index'])->name('student')->middleware('studentaccess');
Route::post('/admin/upload', [AdminController::class, 'upload'])->name('upload');
Route::post('/admin/remove-etudiant', [AdminController::class, 'destroy'])->name('remove-etudiant');
Route::post('/admin/import-prof', [AdminController::class, 'store'])->name('import-prof');
Route::delete('/admin/remove-prof', [AdminController::class, 'destroyProf'])->name('remove-prof');
Route::post('/prof/import', [ProfController::class, 'store'])->name('import-notes');
Route::post('/student/get-notes', [StudentController::class, 'getNotes'])->name('get-notes');
Route::post('/admin/cart-etudiant', [AdminController::class, 'getCarteEtudiant'])->name('get-carte');
Route::get('/admin/export-profs', [AdminController::class, 'exportProfs'])->name('export-profs');
Route::get('/admin/export-etudiants', [AdminController::class, 'exportEtudiants'])->name('export-etudiants');
Route::post('/admin/export-notes', [AdminController::class, 'exportNotes'])->name('export-notes');
