<?php

use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserSubjectsController;
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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/usuarios', [UserController::class, 'index'])->name('user.index');
Route::get('/usuarios/nuevo', [UserController::class, 'create'])->name('user.create');
Route::post('/usuarios/store', [UserController::class, 'store'])->name('user.store');
Route::get('/usuarios/editar/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/usuarios/editar/{id}', [UserController::class, 'update'])->name('user.update');
Route::post('/usuarios/eliminar', [UserController::class, 'destroy'])->name('user.destroy');


Route::get('/materias', [SubjectController::class, 'index'])->name('subject.index');
Route::get('/materias/editar/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
Route::put('/materias/editar/{id}', [SubjectController::class, 'update'])->name('subject.update');
Route::post('/materias/eliminar', [SubjectController::class, 'destroy'])->name('subject.destroy');
Route::get('/materias/nuevo', [SubjectController::class, 'create'])->name('subject.create');
Route::post('/materias/nuevo', [SubjectController::class, 'store'])->name('subject.store');


Route::get('/usuarios-materias/{id_user}', [UserSubjectsController::class, 'index'])->name('user_subjects.index'); //materias que da un docente
Route::post('/usuarios-materias/eliminar', [UserSubjectsController::class, 'destroy'])->name('user_subjects.destroy');
Route::get('/usuarios-materias/editar/{id_user}', [UserSubjectsController::class, 'edit'])->name('user_subjects.edit');
Route::post('/usuarios-materias/editar/{id_user}', [UserSubjectsController::class, 'update'])->name('user_subjects.update');

