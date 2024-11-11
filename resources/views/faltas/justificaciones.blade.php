<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Justificaciones de Faltas') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between mb-6">
                    <x-a class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700" href="{{ route('faltas.index') }}">
                        Revisar Justificaciones
                    </x-a>
                </div>

                <!-- Tabla de asistencia -->
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full w-full border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200">
                                <th class="px-6 py-3 text-left w-1/5">Fecha</th>
                                <th class="px-6 py-3 text-left w-1/5">Estado</th>
                                <th class="px-6 py-3 text-left w-1/5">Razon</th>
                                <th class="px-6 py-3 text-left w-1/5">Evidencia</th>

                            </tr>
                        </thead>
                        <tbody>
                        </tbody>                
                    </table>
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
