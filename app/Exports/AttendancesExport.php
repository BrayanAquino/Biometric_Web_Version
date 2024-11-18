<?php

namespace App\Exports;

use App\Models\Attendance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Carbon\Carbon;

class AttendancesExport implements FromCollection, WithHeadings, WithMapping
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

        return $query->get();
    }

    public function map($attendance): array
    {
        return [
            $attendance->id,
            Carbon::parse($attendance->fecha)->format('d-m-Y'),
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
            'Hora Entrada',
            'Hora Salida',
            'Turno',
            'Estado',
        ];
    }
}
