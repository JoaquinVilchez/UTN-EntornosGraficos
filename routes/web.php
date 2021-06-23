<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InscriptionController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Subject;

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
    return view('home');
});

Auth::routes();

// General
Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');
Route::view('/nosotros', 'contact.about_us')->name('contact.about_us');

// Usuarios
Route::get('/usuarios', [UserController::class, 'list'])->name('user.index');
Route::get('/usuarios/nuevo', [UserController::class, 'create'])->name('user.create');
Route::post('/usuarios/store', [UserController::class, 'store'])->name('user.store');
Route::get('/usuarios/editar/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/usuarios/editar/{id}', [UserController::class, 'update'])->name('user.update');
Route::post('/usuarios/eliminar', [UserController::class, 'destroy'])->name('user.destroy');

Route::get('/docentes', [SubjectUserController::class, 'search_teacher'])->name('users.search_teacher');

// Materias
Route::get('/materias', [SubjectController::class, 'index'])->name('subject.index');
Route::get('/materias/editar/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
Route::put('/materias/editar/{id}', [SubjectController::class, 'update'])->name('subject.update');
Route::post('/materias/eliminar', [SubjectController::class, 'destroy'])->name('subject.destroy');
Route::get('/materias/nuevo', [SubjectController::class, 'create'])->name('subject.create');
Route::post('/materias/nuevo', [SubjectController::class, 'store'])->name('subject.store');
Route::get('/datos-materia/{id}',  [SubjectUserController::class, 'view_subjects_info'])->name('subjects_user.view_subjects_info');

// Materias Usuario
Route::get('/materias-usuario/{id_user}', [SubjectUserController::class, 'index'])->name('subjects_user.index'); //materias que da un docente
Route::get('/materias-usuario/editar/{id_user}', [SubjectUserController::class, 'edit'])->name('subjects_user.edit');
Route::post('/materias-usuario/editar/{id_user}', [SubjectUserController::class, 'update'])->name('subjects_user.update');
Route::get('/materias-usuario/editar/{id_user}/roles', [SubjectUserController::class, 'view_roles_and_status'])->name('subjects_user.view_roles_and_status');
Route::post('/materias-usuario/eliminar/', [SubjectUserController::class, 'destroy'])->name('subjects_user.destroy');

Route::get('/inscripciones', [InscriptionController::class, 'list'])->name('inscriptions_user.list');
Route::post('/inscripciones/cancelar', [InscriptionController::class, 'cancel'])->name('inscription.cancel');

// Route::get('/inscripciones-alumno/{id_user}', [InscriptionController::class, 'index'])->name('inscriptions_user.list');
// Route::get('/materias-consultas/{id_subject}', [SubjectUserController::class, 'view_subjects_meeting'])->name('subjects_user.view_subjects_meeting');
