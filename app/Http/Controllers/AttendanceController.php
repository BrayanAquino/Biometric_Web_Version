<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Attendance;

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

    public function store(Request $request)
    {
        // Validación de los datos
        $request->validate([
            'fecha' => 'required|date',
            'hora_entrada' => 'required',
            'dni' => 'required',
            'shift' => 'required',
        ]);

        // dd($request->all());

        // Buscar el usuario por su DNI
        $user = User::where('dni', $request->dni)->first();
        // dd($user);
        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        try {
            // Guardar la asistencia
            Attendance::create([
                'fecha' => $request->fecha,
                'hora_entrada' => $request->hora_entrada,
                'shift' => $request->shift,
                'attendence_status' => 'Present',
                'user_id' => $user->id,
            ]);

            return redirect()->route('asistencia.index')->with('success', 'Asistencia registrada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al registrar la asistencia: ' . $e->getMessage());
        }
    }

    public function edit(){
        return view('marcacion.marcar_salida');
    }

    public function update(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora_entrada' => 'required',
            'dni' => 'required',
            'shift' => 'required',
        ]);
        // dd($request->all());

        $user = User::where('dni', $request->dni)->first();
        // dd($user);
        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        try {
            $attendance = Attendance::where('user_id', $user->id)
                ->orderBy('fecha', 'desc')
                ->first();
            // dd($attendance);
            if (!$attendance) {
                return back()->with('error', 'No se encontró ninguna entrada de asistencia para este usuario.');
            }

            // Actualizar la asistencia
            $attendance->update([
                'fecha' => $request->fecha,
                'departure_time' => $request->hora_entrada,
                'shift' => $request->shift,
                'attendence_status' => 'Present', 
            ]);

            return redirect()->route('asistencia.index')->with('success', 'Asistencia actualizada correctamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar la asistencia: ' . $e->getMessage());
        }
    }


}
