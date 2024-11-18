<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asistencia Diaria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between mb-6">
                    {{-- <x-a class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700" href="{{ route('asistpersonal.create') }}">
                        Marcar Entrada/Salida
                    </x-a> --}}
                    <x-a class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700" href="{{ route('reportes.export') }}">
                        Generar Reporte
                    </x-a>
                    
                </div>

                <!-- Tabla de asistencia -->
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full w-full border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                <th class="px-6 py-3 text-center w-1/5">Fecha</th>
                                <th class="px-6 py-3 text-center w-1/5">Hora Entrada</th>
                                <th class="px-6 py-3 text-center w-1/5">Hora Salida</th>
                                <th class="px-6 py-3 text-center w-1/5">Turno</th>
                                <th class="px-6 py-3 text-center w-1/5">Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($attendances as $attendance)
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                    <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">{{ \Carbon\Carbon::parse($attendance->fecha)->format('d-m-Y') }}</td>
                                    <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">{{ $attendance->hora_entrada ? \Carbon\Carbon::parse($attendance->hora_entrada)->format('H:i') : 'No registrado' }}</td>
                                    <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">{{ $attendance->departure_time ? \Carbon\Carbon::parse($attendance->departure_time)->format('H:i') : 'No registrado' }}</td>
                                    <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">{{ $attendance->shift }}</td>
                                    <td class="px-6 py-4 text-center text-gray-800 dark:text-gray-200">{{ $attendance->attendence_status }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center px-6 py-4 text-gray-800 dark:text-gray-200">No hay registros de asistencia para este mes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
