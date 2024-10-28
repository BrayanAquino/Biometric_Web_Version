<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('asist_pers.asist_pers');
    })->name('dashboard');
});

Route::get('/reportes', function () {
    return view('reportes.reportes');
})->name('reportes');

Route::get('/usuarios', function () {
    return view('usuarios.usuarios');
})->name('usuarios');

Route::get('/permisos', function () {
    return view('permisos.permisos');
})->name('permisos');

Route::get('/calendario', function () {
    return view('calendario.calendario');
})->name('calendario');
