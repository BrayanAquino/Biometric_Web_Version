<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Permiso') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('permisos.update', $permission->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="start_date" class="block text-sm font-medium text-gray-700">Fecha de Inicio</label>
                        <input type="date" name="start_date" id="start_date" value="{{ old('start_date', $permission->start_date) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 @error('start_date') border-red-500 @enderror" required readonly>
                        @error('start_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700">Fecha de Fin</label>
                        <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $permission->end_date) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 @error('end_date') border-red-500 @enderror" required>
                        @error('end_date')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="reason_permission" class="block text-sm font-medium text-gray-700">Razón del Permiso</label>
                        <textarea name="reason_permission" id="reason_permission" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 @error('reason_permission') border-red-500 @enderror" required readonly>{{ old('reason_permission', $permission->reason_permission) }}</textarea>
                        @error('reason_permission')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    @if($idRol == 1 || $idRol == 2)
                        <div class="mb-4">
                            <label for="status_permission" class="block text-sm font-medium text-gray-700">Estado del Permiso</label>
                            <select name="status_permission" id="status_permission" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 @error('status_permission') border-red-500 @enderror" required>
                                <option value="aprobado" {{ old('status_permission', $permission->status_permission) == 'aprobado' ? 'selected' : '' }}>Aprobado</option>
                                <option value="rechazado" {{ old('status_permission', $permission->status_permission) == 'rechazado' ? 'selected' : '' }}>Rechazado</option>
                                <option value="pendiente" {{ old('status_permission', $permission->status_permission) == 'pendiente' ? 'selected' : '' }}>Pendiente</option>
                            </select>
                            @error('status_permission')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    @endif

                    <div class="mb-4">
                        <label for="evidence_permission" class="block text-sm font-medium text-gray-700">Evidencia (opcional)</label>
                        <input type="file" name="evidence_permission" id="evidence_permission" class="mt-1 block w-full border-red-300 rounded-md shadow-sm focus:ring focus:ring-opacity-50 @error('evidence_permission') border-red-500 @enderror" accept=".pdf,.jpg,.png">
                        @error('evidence_permission')
                            <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>

                    @if($permission->evidences()->exists())
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Evidencia Actual</label>
                            <a href="{{ asset('storage/' . $permission->evidences()->first()->evidence_permission) }}" class="text-blue-600 hover:underline" target="_blank">Ver Evidencia</a>
                        </div>
                    @endif

                    <div class="flex items-center justify-end">
                        <button type="submit" class="ml-4 inline-flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Actualizar Permiso
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>