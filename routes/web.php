<?php

use App\Http\Controllers\UserController;
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

Route::get('/usuarios', [UserController::class, 'index'])->name('user.home');
Route::get('/usuarios/lista', [UserController::class, 'list'])->name('user.list');
Route::get('/usuarios/nuevo', [UserController::class, 'create'])->name('user.create');
Route::post('/usuarios/store', [UserController::class, 'store'])->name('user.store');
Route::get('/usuarios/editar/{id}', [UserController::class, 'edit'])->name('user.edit');
Route::put('/usuarios/editar/{id}', [UserController::class, 'update'])->name('user.update');
Route::post('/usuarios/eliminar', [UserController::class, 'destroy'])->name('user.destroy');
