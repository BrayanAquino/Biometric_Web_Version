<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Editar Permiso para IP') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <form action="{{ route('ip.update', $ip->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <!-- Dirección IP -->
                    <div class="mb-4">
                        <label for="ip" class="block text-gray-700 dark:text-gray-200">Dirección IP:</label>
                        <input type="text" name="ip" id="ip"
                            class="w-full mt-2 p-2 border rounded-md dark:bg-gray-700 dark:text-gray-200"
                            value="{{ old('ip', $ip->ip_address) }}" required>
                    </div>

                    <!-- Botón de envío -->
                    <div class="flex justify-end">
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700">
                            Editar IP
                        </button>
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
</x-app-layout>
