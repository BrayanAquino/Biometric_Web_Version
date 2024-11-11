<?php

use Illuminate\Support\Facades\Route;
use App\Models\User; 
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsistPersController;
Use App\Http\Controllers\CalendarController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return view('asist_pers.asist_pers');
    })->name('dashboard');

    Route::get('/reportes', function () {
        return view('reportes.reportes');
    })->name('reportes');

    Route::get('/permisos', function () {
        return view('permisos.permisos');
    })->name('permisos');

    Route::get('/calendario', function () {
        return view('calendario.calendario');
    })->name('calendario');

    // Usuarios
    Route::get('/usuarios', [UserController::class, 'index'])->name('usuarios.index');
    Route::get('/usuarios/crear', [UserController::class, 'create'])->name('usuarios.create');
    Route::post('/usuarios', [UserController::class, 'store'])->name('usuarios.store');
    Route::get('/usuarios/{id}/editar', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/usuarios/{id}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/usuarios/{id}', [UserController::class, 'destroy'])->name('usuarios.destroy');

    // Asistencia personal
    Route::get('/asist-personal',[AsistPersController::class, 'index'])->name('asistpersonal.index');
    Route::get('/asist.personal/marcar',[AsistPersController::class,'create'])->name('asistpersonal.create');
    Route::post('/asistencia/guardar', [AsistPersController::class, 'store'])->name('asistencia.guardar');
    //Calendario
    Route::get('/calendario',[CalendarController::class, 'index'])->name('calendario.index');



});
