<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Lista de Usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <table class="min-w-full border border-gray-200 dark:border-gray-700">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b dark:border-gray-700 text-left text-gray-800 dark:text-gray-200">ID</th>
                            <th class="px-4 py-2 border-b dark:border-gray-700 text-left text-gray-800 dark:text-gray-200">Nombre</th>
                            <th class="px-4 py-2 border-b dark:border-gray-700 text-left text-gray-800 dark:text-gray-200">Apellido</th>
                            <th class="px-4 py-2 border-b dark:border-gray-700 text-left text-gray-800 dark:text-gray-200">Email</th>
                            <th class="px-4 py-2 border-b dark:border-gray-700 text-left text-gray-800 dark:text-gray-200">Teléfono</th>
                            <th class="px-4 py-2 border-b dark:border-gray-700 text-left text-gray-800 dark:text-gray-200">Fecha de Contratación</th>
                            <th class="px-4 py-2 border-b dark:border-gray-700 text-left text-gray-800 dark:text-gray-200">Estado</th>
                            <th class="px-4 py-2 border-b dark:border-gray-700 text-left text-gray-800 dark:text-gray-200">Rol</th>
                            <th class="px-4 py-2 border-b dark:border-gray-700 text-left text-gray-800 dark:text-gray-200">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $user->id }}</td>
                                <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $user->name }}</td>
                                <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $user->lastname }}</td>
                                <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $user->email }}</td>
                                <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $user->cellphone }}</td>
                                <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">
                                    {{ \Carbon\Carbon::parse($user->hiring_date)->format('d-m-Y') }}
                                </td>
                                <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ $user->state }}</td>
                                <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">{{ optional($user->role)->name_rol }}</td>
                                <td class="px-4 py-2 border-b dark:border-gray-700 text-center text-gray-800 dark:text-gray-200">
                                    <a href="{{ route('usuarios.edit', $user->id) }}" class="text-indigo-600 hover:text-indigo-900">Actualizar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
