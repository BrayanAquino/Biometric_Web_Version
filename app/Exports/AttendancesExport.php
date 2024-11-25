<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttendancesExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    protected $filterDate;

    public function __construct($filterDate = null)
    {
        $this->filterDate = $filterDate;
    }

    public function collection()
    {
        $query = Attendance::query();

        if ($this->filterDate) {
            $query->where('fecha', '=', $this->filterDate);
        }

        return $query->with('user')->get(); // Asegúrate de cargar la relación 'user'
    }

    public function map($attendance): array
    {
        return [
            $attendance->id,
            Carbon::parse($attendance->fecha)->format('d-m-Y'),
            $attendance->user->name,  // Agregar el nombre del usuario
            $attendance->user->lastname,  // Agregar los apellidos del usuario
            $attendance->hora_entrada ? Carbon::parse($attendance->hora_entrada)->format('H:i') : 'No registrado',
            $attendance->departure_time ? Carbon::parse($attendance->departure_time)->format('H:i') : 'No registrado',
            $attendance->shift,
            $attendance->attendence_status,
        ];
    }

    public function headings(): array
    {
        return [
            'ID',
            'Fecha',
            'Nombre',  // Encabezado para Nombre
            'Apellidos',  // Encabezado para Apellidos
            'Hora Entrada',
            'Hora Salida',
            'Turno',
            'Estado',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // Estilos para los encabezados
        $sheet->getStyle('A1:H1')->getFont()->setBold(true)->setSize(12); // Cambiar el rango a A1:H1
        $sheet->getStyle('A1:H1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB('D3D3D3'); // Gris claro
        $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal('center')->setVertical('center');

        // Estilos para las filas de datos
        $rows = $sheet->getHighestRow();
        for ($row = 2; $row <= $rows; $row++) {
            // Color alterno para las filas
            $color = $row % 2 == 0 ? 'FFFFFF' : 'F2F2F2'; // Alternar entre blanco y gris claro
            $sheet->getStyle("A$row:H$row")->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($color);
            $sheet->getStyle("A$row:H$row")->getAlignment()->setHorizontal('center')->setVertical('center');
        }
    }
}
