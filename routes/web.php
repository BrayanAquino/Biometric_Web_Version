<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AsistPersController;
Use App\Http\Controllers\CalendarController;
use App\Http\Controllers\PermissionsController;
use App\Http\Controllers\TardinessController;
use App\Http\Controllers\JustTardController;
use App\Http\Controllers\AbsencesController;
use App\Http\Controllers\JustAbsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [AsistPersController::class, 'index'])->name('dashboard');

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

    //Permisos
    Route::get('/permisos',[PermissionsController::class, 'index'])->name('permisos.index');
    Route::get('/permisos/crear',[PermissionsController::class,'create'])->name('permisos.create');
    Route::post('/permisos', [PermissionsController::class, 'store'])->name('permisos.store');
    Route::get('/permisos/{id}', [PermissionsController::class, 'show'])->name('permisos.show');
    Route::get('/evidencias/descargar/{id}', [PermissionsController::class, 'downloadEvidence'])->name('evidencias.descargar');
    Route::get('/permisos/{id}/editar', [PermissionsController::class, 'edit'])->name('permisos.edit');
    Route::put('/permisos/{id}', [PermissionsController::class, 'update'])->name('permisos.update');
    //Tardanzas
    Route::get('/tardanzas',[TardinessController::class, 'index'])->name('tardanzas.index');
    Route::get('/tardanzas/justificaciones',[JustTardController::class, 'index'])->name('tardanzas.justificaciones');

    //Faltas
    Route::get('/faltas',[AbsencesController::class, 'index'])->name('faltas.index');
    Route::get('/faltas/justificaciones',[JustAbsController::class, 'index'])->name('faltas.justificaciones');

});

    //Marcación de Asistencia
    Route::get('/marcar', [AttendanceController::class,'index'])->name('asistencia.index');
    Route::get('/marcar/qr_scaner', [AttendanceController::class,'create'])->name('asistencia.create');
    Route::post('/marcar', [AttendanceController::class,'store'])->name('asistencia.store');
    Route::get('/marcar_salida', [AttendanceController::class,'edit'])->name('asistencia.edit');
    Route::post('/asistencia/update', [AttendanceController::class, 'update'])->name('asistencia.update');

    //Reportes
    Route::get('/asistencias-hoy', [ReportController::class, 'today'])->name('reportes.today');
    Route::get('/asistencias-30-dias', [ReportController::class, 'last30Days'])->name('reportes.last30days');
    Route::get('/exportar-asistencias', [ReportController::class, 'export'])->name('reportes.export');
    Route::get('/reporte-asistencia-diaria', [AsistPersController::class, 'exportDailyAttendances'])->name('asistencias.diarias.export');



