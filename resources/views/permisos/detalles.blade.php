<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detalle de permiso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <div class="mb-4">
                    <h3 class="text-lg font-semibold">Información del Permiso</h3>
                </div>

                <div class="mb-4">
                    <strong>Empleado:</strong> {{ $permission->user->name }}<br>
                    <strong>Fecha Inicio:</strong> {{ $permission->start_date }}<br>
                    <strong>Fecha Fin:</strong> {{ $permission->end_date }}<br>
                    <strong>Razón:</strong> {{ $permission->reason_permission }}<br>
                    <strong>Estado:</strong> {{ $permission->status_permission }}<br>
                </div>

                <div class="flex justify-end">
                    <x-a href="{{ route('permisos.index') }}" class="px-4 py-2 bg-gray-500 text-white rounded-md hover:bg-gray-700">
                        Volver a la lista
                    </x-a>

                    @if($permission->evidences()->exists()) <!-- Verifica si existe evidencia en la tabla relacionada -->
                        <x-a href="{{ route('evidencias.descargar', $permission->id) }}" class="ml-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                            Descargar Evidencias
                        </x-a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>