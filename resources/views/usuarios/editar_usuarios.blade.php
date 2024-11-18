<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Actualizar usuario') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('usuarios.update', $user->id) }}">
                        @csrf
                        @method('PUT')
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="name" class="block font-medium text-sm text-gray-700">Nombre</label>
                                <input id="name" type="text" name="name" value="{{ $user->name }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="lastname" class="block font-medium text-sm text-gray-700">Apellido</label>
                                <input id="lastname" type="text" name="lastname" value="{{ $user->lastname }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div class="mb-4">
                                <label for="dni" class="block text-gray-700 dark:text-gray-200">DNI:</label>
                                <input id="dni" type="text" name="dni" value="{{ $user->dni }}"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>

                            <div>
                                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                                <input id="email" type="email" name="email" value="{{ $user->email }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="password" class="block font-medium text-sm text-gray-700">Nueva Contraseña</label>
                                <input id="password" type="password" name="password"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="cellphone" class="block font-medium text-sm text-gray-700">Teléfono</label>
                                <input id="cellphone" type="text" name="cellphone" value="{{ $user->cellphone }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="hiring_date" class="block font-medium text-sm text-gray-700">Fecha de contratación</label>
                                <input id="hiring_date" type="date" name="hiring_date" value="{{ \Carbon\Carbon::parse($user->hiring_date)->format('Y-m-d') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="state" class="block font-medium text-sm text-gray-700">Estado</label>
                                <select id="state" name="state" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" disabled>Seleccione un estado</option>
                                    <option value="activo" {{ $user->state == 'activo' ? 'selected' : '' }}>Activo</option>
                                    <option value="inactivo" {{ $user->state == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                            </div>

                            <div>
                                <label for="rol_id" class="block font-medium text-sm text-gray-700">Rol</label>
                                <select id="rol_id" name="rol_id" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" disabled>Seleccione un rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" {{ $user->rol_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name_rol }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-button>
                                Actualizar Usuario
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
