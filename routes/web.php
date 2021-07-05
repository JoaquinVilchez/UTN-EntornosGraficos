<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubjectUserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InscriptionController;
use App\Http\Controllers\MeetingController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Subject;
use Illuminate\Support\Facades\Auth;
use Spatie\Sitemap\SitemapGenerator;

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

Route::get('/contrasena', function () {
    return Hash::make('123456789');
});

Auth::routes();
// General

Route::get('/', [UserController::class, 'index'])->name('home');
Route::get('/contacto', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contacto', [ContactController::class, 'send'])->name('contact.send');
Route::view('/nosotros', 'contact.about_us')->name('contact.about_us');

// Usuarios
Route::group(['middleware' => 'admin'], function () {
    Route::get('/usuarios/editar/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/usuarios/editar/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('/usuarios', [UserController::class, 'list'])->name('user.index');
    Route::get('/usuarios/nuevo', [UserController::class, 'create'])->name('user.create');
    Route::post('/usuarios/store', [UserController::class, 'store'])->name('user.store');
    Route::post('/usuarios/eliminar', [UserController::class, 'destroy'])->name('user.destroy');
    Route::post('/materia/docentes', [UserController::class, 'getTeachersFromSubject'])->name('user.getTeachersFromSubject');
});

Route::get('/mi-usuario/editar', [UserController::class, 'my_user'])->name('user.my_user');
Route::put('/mi-usuario/editar', [UserController::class, 'my_user_update'])->name('user.my_user_update');


Route::get('/docentes', [SubjectUserController::class, 'search_teacher'])->name('users.search_teacher');

// Materias
Route::group(['middleware' => 'admin'], function () {
    Route::get('/materias', [SubjectController::class, 'index'])->name('subject.index');
    Route::get('/materias/editar/{id}', [SubjectController::class, 'edit'])->name('subject.edit');
    Route::put('/materias/editar/{id}', [SubjectController::class, 'update'])->name('subject.update');
    Route::post('/materias/eliminar', [SubjectController::class, 'destroy'])->name('subject.destroy');
    Route::get('/materias/nuevo', [SubjectController::class, 'create'])->name('subject.create');
    Route::post('/materias/nuevo', [SubjectController::class, 'store'])->name('subject.store');
});





Route::group(['middleware' => 'admin'], function () {
    Route::get('/datos-materia/{id}',  [SubjectUserController::class, 'view_subjects_info'])->name('subjects_user.view_subjects_info');
});

// Materias Usuario

Route::get('/materias-usuario/{id_user}', [SubjectUserController::class, 'index'])->name('subjects_user.index'); //materias que da un docente
Route::group(['middleware' => 'admin-docente'], function () {
    Route::get('/materias-usuario/editar/{id_user}', [SubjectUserController::class, 'edit'])->name('subjects_user.edit');
    Route::post('/materias-usuario/editar/{id_user}', [SubjectUserController::class, 'update'])->name('subjects_user.update');
    Route::get('/materias-usuario/editar/{id_user}/roles', [SubjectUserController::class, 'view_roles_and_status'])->name('subjects_user.view_roles_and_status');
    Route::post('/materias-usuario/eliminar/', [SubjectUserController::class, 'destroy'])->name('subjects_user.destroy');
});

//Inscripciones
Route::get('/mis-inscripciones', [InscriptionController::class, 'list'])->name('inscriptions_user.list');
Route::post('/mis-inscripciones/cancelar/', [InscriptionController::class, 'cancel'])->name('inscriptions_user.cancel');
Route::get('/inscripciones/nueva/seleccionar-materia', [InscriptionController::class, 'select_subject'])->name('inscriptions_user.select_subject');
Route::get('/inscripciones/nueva', [InscriptionController::class, 'create'])->name('inscriptions_user.create');
Route::post('/inscripciones/nueva/seleccionar-docente', [InscriptionController::class, 'selectTeacher'])->name('inscriptions_user.select_teacher');
Route::post('/inscripciones/nueva/seleccionar-consulta', [InscriptionController::class, 'selectMeeting'])->name('inscriptions_user.select_meeting');
Route::post('/inscripciones/nueva/', [InscriptionController::class, 'store'])->name('inscriptions_user.store');

//Consultas


Route::group(['middleware' => 'admin-docente'], function () {
    Route::get('/consultas/nuevo', [MeetingController::class, 'create'])->name('meetings.create');
    Route::get('/mis-consultas/nuevo/', [MeetingController::class, 'create_for_teacher'])->name('meetings.create_for_teacher');
    Route::post('/consultas/nuevo', [MeetingController::class, 'store'])->name('meetings.store');
    Route::get('/consultas/editar/{id}', [MeetingController::class, 'edit'])->name('meetings.edit');
    Route::put('/consultas/editar/{id}', [MeetingController::class, 'update'])->name('meetings.update');
    Route::post('/consultas/eliminar', [MeetingController::class, 'destroy'])->name('meetings.destroy');
});

Route::group(['middleware' => 'admin'], function () {
    Route::get('/consultas', [MeetingController::class, 'list'])->name('meetings.list');
    Route::get('/consultas/exportar', [MeetingController::class, 'export'])->name('meetings.export');
    Route::post('/consultas/importar', [MeetingController::class, 'import'])->name('meetings.import');
});

Route::get('/mis-consultas', [MeetingController::class, 'my_meetings'])->name('meetings.my_meetings');
Route::get('/consulta/{meeting_id}/{datetime}', [MeetingController::class, 'meeting_details'])->name('meetings.meeting_details');
Route::post('/mis-consultas/cancelar', [MeetingController::class, 'cancel'])->name('meetings.cancel');
Route::get('/mis-consultas/historial', [MeetingController::class, 'history'])->name('meetings.history');

Route::get('sitemap', function () {
    SitemapGenerator::create('http://entornosgraficos2021.tk/')->writeToFile('sitemap.xml');
    return 'sitemap created';
});
Route::view('/mapa', 'contact.sitemap')->name('contact.sitemap');
