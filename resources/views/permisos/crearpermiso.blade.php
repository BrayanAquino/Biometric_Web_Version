<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Crear Permiso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                {{-- <form action="{{ route('permissions.store') }}" method="POST" enctype="multipart/form-data"> --}}
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <!-- Fecha de inicio -->
                    <div class="mb-4">
                        <label for="start_date" class="block text-gray-700 dark:text-gray-200">Fecha de Inicio:</label>
                        <input type="date" name="start_date" id="start_date" class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200" required>
                    </div>

                    <!-- Fecha de fin -->
                    <div class="mb-4">
                        <label for="end_date" class="block text-gray-700 dark:text-gray-200">Fecha de Fin:</label>
                        <input type="date" name="end_date" id="end_date" class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200" required>
                    </div>

                    <!-- Razón del permiso -->
                    <div class="mb-4">
                        <label for="reason_permission" class="block text-gray-700 dark:text-gray-200">Razón del Permiso:</label>
                        <textarea name="reason_permission" id="reason_permission" rows="4" class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200" required></textarea>
                    </div>

                    <!-- Estado del permiso -->
                    <div class="mb-4">
                        <label for="status_permission" class="block text-gray-700 dark:text-gray-200">Estado del Permiso:</label>
                        <select name="status_permission" id="status_permission" class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200" required>
                            <option value="Pendiente">Pendiente</option>
                            <option value="Aprobado">Aprobado</option>
                            <option value="Rechazado">Rechazado</option>
                        </select>
                    </div>

                    <!-- Evidencia del permiso -->
                    <div class="mb-4">
                        <label for="evidence_permission" class="block text-gray-700 dark:text-gray-200">Evidencia del Permiso:</label>
                        <input type="file" name="evidence_permission" id="evidence_permission" class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200" accept=".pdf,.jpg,.png">
                    </div>

                    <!-- Botón de envío -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                            Registrar Permiso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
