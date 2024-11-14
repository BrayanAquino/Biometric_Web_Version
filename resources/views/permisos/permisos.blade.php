<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Permisos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between mb-6">
                    <x-a class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700" href="{{ route('permisos.create') }}">
                        Generar Permiso
                    </x-a>
                </div>

                <!-- Tabla de permisos -->
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">Empleado</th>
                                <th class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">Fecha Inicio</th>
                                <th class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">Fecha Fin</th>
                                <th class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">Razón</th>
                                <th class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">Estado</th>
                                <th class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $permission->user->name }}</td> <!-- Nombre del empleado -->
                                    <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $permission->start_date }}</td>
                                    <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $permission->end_date }}</td>
                                    <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $permission->reason_permission }}</td>
                                    <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $permission->status_permission }}</td>
                                    <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">
                                        {{-- <x-a href="{{ route('permisos.edit', $permission->id) }}" class="text-indigo-600 hover:text-indigo-900">Editar</x-a> --}}
                                        <x-a href="" class="text-indigo-600 hover:text-indigo-900">Editar</x-a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
