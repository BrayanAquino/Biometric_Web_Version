<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear nuevos usuarios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form method="POST" action="{{ route('usuarios.store') }}" enctype="multipart/form-data">
                    @csrf
                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Datos Personales</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="mb-4">
                            <label for="name" class="block text-gray-700 dark:text-gray-200">Nombre:</label>
                            <input id="name" type="text" name="name" required
                                class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="lastname" class="block text-gray-700 dark:text-gray-200">Apellido:</label>
                            <input id="lastname" type="text" name="lastname"
                                class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="email" class="block text-gray-700 dark:text-gray-200">Email:</label>
                            <input id="email" type="email" name="email" required
                                class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="password" class="block text-gray-700 dark:text-gray-200">Contraseña:</label>
                            <input id="password" type="password" name="password" required
                                class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="cellphone" class="block text-gray-700 dark:text-gray-200">Teléfono:</label>
                            <input id="cellphone" type="text" name="cellphone"
                                class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="hiring_date" class="block text-gray-700 dark:text-gray-200">Fecha de contratación:</label>
                            <input id="hiring_date" type="date" name="hiring_date"
                                class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="state" class="block text-gray-700 dark:text-gray-200">Estado:</label>
                            <select id="state" name="state" required
                                class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled>Seleccione un estado</option>
                                <option value="activo">Activo</option>
                                <option value="inactivo">Inactivo</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="rol_id" class="block text-gray-700 dark:text-gray-200">Rol:</label>
                            <select id="rol_id" name="rol_id" required
                                class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled>Seleccione un rol</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}">{{ $role->name_rol }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr class="mt-8 mb-6">

                    <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Horario</h3>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="mb-4">
                            <div class="mb-4">
                                <label for="turno_mañana" class="block text-gray-700 dark:text-gray-200">Turno mañana</label>
                                <input type="checkbox" name="turno_mañana" id="turno_mañana" class="mt-2">
                            </div>
                            <div class="mb-4">
                                <label for="h_e_mañana" class="block text-gray-700 dark:text-gray-200">Hora de Entrada</label>
                                <input type="time" name="h_e_mañana" id="h_e_mañana"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>
                            <div class="mb-4">
                                <label for="h_s_mañana" class="block text-gray-700 dark:text-gray-200">Hora de Salida</label>
                                <input type="time" name="h_s_mañana" id="h_s_mañana"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div>
                                <label for="turno_tarde" class="block text-gray-700 dark:text-gray-200">Turno tarde</label>
                                <input type="checkbox" name="turno_tarde" id="turno_tarde" class="mt-2">
                            </div>
                            <div class="mb-4">
                                <label for="h_e_tarde" class="block text-gray-700 dark:text-gray-200">Hora de Entrada</label>
                                <input type="time" name="h_e_tarde" id="h_e_tarde"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>
                            <div class="mb-4">
                                <label for="h_s_tarde" class="block text-gray-700 dark:text-gray-200">Hora de Salida</label>
                                <input type="time" name="h_s_tarde" id="h_s_tarde"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>
                        </div>
                        <div class="mb-4">
                            <div>
                                <label for="turno_noche" class="block text-gray-700 dark:text-gray-200">Turno noche</label>
                                <input type="checkbox" name="turno_noche" id="turno_noche" class="mt-2">
                            </div>
                            <div class="mb-4">
                                <label for="h_e_noche" class="block text-gray-700 dark:text-gray-200">Hora de Entrada</label>
                                <input type="time" name="h_e_noche" id="h_e_noche"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>
                            <div class="mb-4">
                                <label for="h_s_noche" class="block text-gray-700 dark:text-gray-200">Hora de Salida</label>
                                <input type="time" name="h_s_noche" id="h_s_noche"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>
                        </div>
                    </div>

                    <!-- Botón de envío -->
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                            Crear Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
