<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('marcacion.marcar');
    }

    public function create()
    {
        return view('marcacion.marcar_entrada');
    }
}
