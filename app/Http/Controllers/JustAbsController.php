<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JustAbsController extends Controller
{
    public function index()
    {
        return view('faltas.justificaciones');
    }
}
