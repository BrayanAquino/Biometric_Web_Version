<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TardinessController extends Controller
{
    public function index()
    {
        return view('tardanzas.tardanzas');
    }

    public function create()
    {
        return view('tardanzas.justificaciones');
    }
}
