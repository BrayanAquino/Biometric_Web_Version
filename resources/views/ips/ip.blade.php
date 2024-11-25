<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de IP para marcar') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <div class="flex justify-between mb-6">
                    <x-a class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700" href="{{ route('ip.create') }}">
                        Generar Permiso a IP
                    </x-a>
                </div>

                <!-- Tabla de permisos -->
                <div class="overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="min-w-full border border-gray-200 dark:border-gray-700">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">ID</th>
                                <th class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">IP</th>
                                <th class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($ips as $ip)
                                <tr>
                                    
                                    <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $ip->id }}</td>
                                    <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $ip->ip_address }}</td>
                                    <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">
                                        <a href="{{ route('ip.edit', $ip->id) }}" class="text-indigo-600 hover:text-indigo-900">Actualizar</a>
                                        <form action="{{ route('ip.destroy', $ip->id) }}" method="POST" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                        </form>                                        
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center px-6 py-4 text-gray-800 dark:text-gray-200">No hay IPs registrados</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
