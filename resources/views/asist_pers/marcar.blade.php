<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Marcar Asistencia') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form action="{{ route('asistencia.guardar') }}" method="POST" id="asistenciaForm">
                    @csrf
                    <div class="space-y-6">
                        <div class="flex flex-col space-y-2">
                            <label for="fecha" class="text-gray-700 dark:text-gray-200 font-medium">Fecha</label>
                            <input type="date" id="fecha" name="fecha" value="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" readonly class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200 px-4 py-2 rounded-md w-full">
                        </div>
                        
                        <div class="flex flex-col space-y-2">
                            <label for="hora_entrada" class="text-gray-700 dark:text-gray-200 font-medium">Hora Entrada</label>
                            <input type="text" id="hora_entrada" name="hora_entrada" class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200 px-4 py-2 rounded-md w-full" readonly>
                        </div>
                        
                        <div class="flex flex-col space-y-2">
                            <label for="hora_salida" class="text-gray-700 dark:text-gray-200 font-medium">Hora Salida</label>
                            <input type="text" id="hora_salida" name="hora_salida" class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200 px-4 py-2 rounded-md w-full" readonly>
                        </div>

                        <div class="flex flex-col space-y-2">
                            <label for="turno" class="text-gray-700 dark:text-gray-200 font-medium">Turno</label>
                            <select id="turno" name="turno" class="bg-gray-100 text-gray-700 dark:bg-gray-700 dark:text-gray-200 px-4 py-2 rounded-md w-full">
                                <option value="Mañana">Mañana</option>
                                <option value="Tarde">Tarde</option>
                                <option value="Noche">Noche</option>
                            </select>
                        </div>
                        
                        <div class="flex justify-between mt-4">
                            <x-a type="button" id="marcarEntrada" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700">Marcar Entrada</x-a>
                            <x-a type="button" id="marcarSalida" class="px-4 py-2 bg-red-500 text-white rounded-md hover:bg-red-700" disabled>Marcar Salida</x-a>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="w-full px-4 py-2 bg-indigo-500 text-white rounded-md hover:bg-indigo-700">Guardar Asistencia</button>
                        </div>
                    </div>
                </form>
                               
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Función para obtener la hora actual
            function getCurrentTime() {
                const now = new Date();
                const hours = String(now.getHours()).padStart(2, '0');
                const minutes = String(now.getMinutes()).padStart(2, '0');
                return `${hours}:${minutes}`; // Devuelve la hora en formato HH:mm
            }

            // Función para marcar entrada
            window.marcarEntrada = function() {
                const fecha = document.getElementById('fecha').value; // Obtener la fecha del input
                document.getElementById('hora_entrada').value = `${fecha} ${getCurrentTime()}`; // Combinar fecha y hora
                document.getElementById('marcarSalida').disabled = false; // Habilitar el botón de marcar salida
            }

            // Función para marcar salida
            window.marcarSalida = function () {
                const fecha = document.getElementById('fecha').value; // Obtener la fecha del input
                document.getElementById('hora_salida').value = `${fecha} ${getCurrentTime()}`; // Combinar fecha y hora
                document.getElementById('marcarSalida').disabled = true; // Deshabilitar el botón de marcar salida
            }

            // Asignar las funciones a los botones
            document.getElementById('marcarEntrada').addEventListener('click', marcarEntrada);
            document.getElementById('marcarSalida').addEventListener('click', marcarSalida);
        });
    </script>
</x-app-layout>