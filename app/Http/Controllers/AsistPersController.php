<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Exports\AttendancesExport;
use Maatwebsite\Excel\Facades\Excel;

class AsistPersController extends Controller
{
    public function index()
    {
        $userId = Auth::id();  
        
        $currentMonth = Carbon::now()->month; 
        $currentYear = Carbon::now()->year;  
        
        $attendances = Attendance::where('user_id', $userId)
            ->whereMonth('fecha', $currentMonth) 
            ->whereYear('fecha', $currentYear)  
            ->get();
        
        return view('asist_pers.asist_pers', compact('attendances'));
    }

    public function create()
    {
        return view('asist_pers.marcar');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora_entrada' => 'required|string',
            'hora_salida' => 'required|string',
            'turno' => 'required|string',
        ]);

        $userId = Auth::id();

        $attendance = new Attendance();
        $attendance->fecha = $request->input('fecha'); 
        $attendance->hora_entrada = $request->input('hora_entrada'); 
        $attendance->departure_time = $request->input('hora_salida');
        $attendance->shift = $request->input('turno'); 
        $attendance->attendence_status = 'Present';
        $attendance->user_id = $userId; 

        $attendance->save();

        return redirect()->route('asistpersonal.index')->with('success', 'Asistencia registrada con éxito.');
    }

    public function exportDailyAttendances()
    {
        $today = Carbon::today();
        return Excel::download(new AttendancesExport($today), 'asistencias_diarias_' . $today->format('d-m-Y') . '.xlsx');
    }

}
