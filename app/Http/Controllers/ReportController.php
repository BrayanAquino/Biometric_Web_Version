<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Exports\AttendancesExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportController extends Controller
{
    // Función para mostrar las asistencias del día actual
    public function today()
    {
        // Obtiene la fecha actual
        $today = Carbon::today();

        // Recupera las asistencias del día actual
        $attendances = Attendance::whereDate('fecha', $today)->get();

        // Pasa los datos a la vista
        return view('reportes.reportes', compact('attendances'));
    }

    // Función para mostrar las asistencias de los últimos 30 días
    public function last30Days()
    {
        // Obtiene la fecha actual
        $today = Carbon::today();

        // Recupera las asistencias de los últimos 30 días
        $attendances = Attendance::where('fecha', '>=', $today->subDays(30))->get();

        // Pasa los datos a la vista
        return view('reportes.reportes', compact('attendances'));
    }

    public function export()
    {
        // Genera el archivo Excel con los datos
        return Excel::download(new AttendancesExport, 'asistencias.xlsx');
    }
}

