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
                                <label for="dni" class="block font-medium text-sm text-gray-700">DNI:</label>
                                <input id="dni" type="text" name="dni" value="{{ $user->dni }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                                <input id="email" type="email" name="email" value="{{ $user->email }}" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="password" class="block font-medium text-sm text-gray-700">Nueva
                                    Contraseña</label>
                                <input id="password" type="password" name="password"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="cellphone" class="block font-medium text-sm text-gray-700">Teléfono</label>
                                <input id="cellphone" type="text" name="cellphone" value="{{ $user->cellphone }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="hiring_date" class="block font-medium text-sm text-gray-700">Fecha de
                                    contratación</label>
                                <input id="hiring_date" type="date" name="hiring_date"
                                    value="{{ \Carbon\Carbon::parse($user->hiring_date)->format('Y-m-d') }}"
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>

                            <div>
                                <label for="state" class="block font-medium text-sm text-gray-700">Estado</label>
                                <select id="state" name="state" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" disabled>Seleccione un estado</option>
                                    <option value="activo" {{ $user->state == 'activo' ? 'selected' : '' }}>Activo
                                    </option>
                                    <option value="inactivo" {{ $user->state == 'inactivo' ? 'selected' : '' }}>Inactivo
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label for="rol_id" class="block font-medium text-sm text-gray-700">Rol</label>
                                <select id="rol_id" name="rol_id" required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <option value="" disabled>Seleccione un rol</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}"
                                            {{ $user->rol_id == $role->id ? 'selected' : '' }}>
                                            {{ $role->name_rol }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <hr class="mt-8 mb-6">

                        <h3 class="font-semibold text-lg text-gray-800 dark:text-gray-200 mb-4">Horario</h3>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="mb-4">
                                <label for="turno_mañana" class="block text-gray-700 dark:text-gray-200">Turno
                                    mañana</label>
                                <input type="checkbox" name="turno_mañana" id="turno_mañana" class="mt-2"
                                    {{ $user->schedules->where('shift', 'mañana')->isNotEmpty() ? 'checked' : '' }}>

                                <label for="h_e_mañana" class="block text-gray-700 dark:text-gray-200">Hora de
                                    Entrada</label>
                                <input type="time" name="h_e_mañana" id="h_e_mañana"
                                    {{ $user->schedules->where('shift', 'mañana')->isNotEmpty() ? '' : 'disabled' }}
                                    value="{{ $user->schedules->where('shift', 'mañana')->first()->start_time ?? '' }}"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">

                                <label for="h_s_mañana" class="block text-gray-700 dark:text-gray-200">Hora de
                                    Salida</label>
                                <input type="time" name="h_s_mañana" id="h_s_mañana"
                                    {{ $user->schedules->where('shift', 'mañana')->isNotEmpty() ? '' : 'disabled' }}
                                    value="{{ $user->schedules->where('shift', 'mañana')->first()->end_time ?? '' }}"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>

                            <div class="mb-4">
                                <label for="turno_tarde" class="block text-gray-700 dark:text-gray-200">Turno
                                    tarde</label>
                                <input type="checkbox" name="turno_tarde" id="turno_tarde" class="mt-2"
                                    {{ $user->schedules->where('shift', 'tarde')->isNotEmpty() ? 'checked' : '' }}>

                                <label for="h_e_tarde" class="block text-gray-700 dark:text-gray-200">Hora de
                                    Entrada</label>
                                <input type="time" name="h_e_tarde" id="h_e_tarde"
                                    {{ $user->schedules->where('shift', 'tarde')->isNotEmpty() ? '' : 'disabled' }}
                                    value="{{ $user->schedules->where('shift', 'tarde')->first()->start_time ?? '' }}"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">

                                <label for="h_s_tarde" class="block text-gray-700 dark:text-gray-200">Hora de
                                    Salida</label>
                                <input type="time" name="h_s_tarde" id="h_s_tarde"
                                    {{ $user->schedules->where('shift', 'tarde')->isNotEmpty() ? '' : 'disabled' }}
                                    value="{{ $user->schedules->where('shift', 'tarde')->first()->end_time ?? '' }}"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>

                            <div class="mb-4">
                                <label for="turno_noche" class="block text-gray-700 dark:text-gray-200">Turno
                                    noche</label>
                                <input type="checkbox" name="turno_noche" id="turno_noche" class="mt-2"
                                    {{ $user->schedules->where('shift', 'noche')->isNotEmpty() ? 'checked' : '' }}>

                                <label for="h_e_noche" class="block text-gray-700 dark:text-gray-200">Hora de
                                    Entrada</label>
                                <input type="time" name="h_e_noche" id="h_e_noche"
                                    {{ $user->schedules->where('shift', 'noche')->isNotEmpty() ? '' : 'disabled' }}
                                    value="{{ $user->schedules->where('shift', 'noche')->first()->start_time ?? '' }}"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">

                                <label for="h_s_noche" class="block text-gray-700 dark:text-gray-200">Hora de
                                    Salida</label>
                                <input type="time" name="h_s_noche" id="h_s_noche"
                                    {{ $user->schedules->where('shift', 'noche')->isNotEmpty() ? '' : 'disabled' }}
                                    value="{{ $user->schedules->where('shift', 'noche')->first()->end_time ?? '' }}"
                                    class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200">
                            </div>
                        </div>

                        <div class="mt-6">
                            <x-button>
                                Actualizar Usuario
                            </x-button>
                        </div>
                    </form>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Asociar eventos a los checkboxes
            ['mañana', 'tarde', 'noche'].forEach(turno => {
                const checkbox = document.getElementById(`turno_${turno}`);
                const entrada = document.getElementById(`h_e_${turno}`);
                const salida = document.getElementById(`h_s_${turno}`);

                checkbox.addEventListener('change', function() {
                    const isEnabled = checkbox.checked;
                    entrada.disabled = !isEnabled;
                    salida.disabled = !isEnabled;
                });
            });
        });
    </script>
</x-app-layout>
