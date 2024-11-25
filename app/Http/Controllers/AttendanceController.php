<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Schedule;
use App\Models\Attendance;
use App\Models\IP;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $clientIp = $request->header('X-Forwarded-For') ?? $request->ip();
        
        if ($clientIp == '127.0.0.1' || $clientIp == '::1') {
            return view('marcacion.marcar');
        }

        $ipRegistered = IP::where('ip_address', $clientIp)->exists();

        if (!$ipRegistered) {
            return redirect()->route('dashboard')->with('error', 'Acceso denegado. Su IP no está registrada.');
        }

        return view('marcacion.marcar');
    }


    public function create()
    {
        return view('marcacion.marcar_entrada');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora_entrada' => 'required',
            'dni' => 'required',
            'shift' => 'required',
        ]);
    
        $user = User::where('dni', $request->dni)->first();
    
        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }
    
        try {
            $schedules = Schedule::where('id_user', $user->id)->first();
            dd($schedules);
    
            if ($schedules) {
                // Convertir start_time a formato H:i
                $hora_llegada_horario = Carbon::parse($schedules->start_time)->format('H:i');
            } else {
                $hora_llegada_horario = 'No registrado';
            }
    
            $hora_entrada = Carbon::parse($request->hora_entrada)->format('H:i');
            $status = 'A tiempo'; 
    
            if ($hora_entrada > $hora_llegada_horario) {
                $status = 'Tarde';
            }
    
            // Crear la asistencia
            Attendance::create([
                'fecha' => $request->fecha,
                'hora_entrada' => $request->hora_entrada,
                'shift' => $request->shift,
                'attendence_status' => $status, 
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

        if (!$user) {
            return back()->with('error', 'Usuario no encontrado.');
        }

        try {
            $attendance = Attendance::where('user_id', $user->id)
                ->orderBy('id', 'desc')
                ->first();
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
