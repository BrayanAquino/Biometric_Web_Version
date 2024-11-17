<x-guest-layout>
    <x-authentication-card class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md text-center">
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white text-center">Marcación</h2>
        <h1 id="current-date" class="text-gray-600 dark:text-gray-400 mt-4 text-center"></h1>
        <h1 id="current-time" class="text-gray-600 dark:text-gray-400 mt-2 text-center"></h1>

        <div class="flex justify-around mt-6">
            <div class="flex-1 flex justify-center">
                <x-a class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600" href="{{ route('asistencia.create') }}">Marcar Entrada</x-a>
            </div>
            <div class="flex-1 flex justify-center">
                <x-a class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Marcar Salida</x-a>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>

<script>
    function updateDateTime() {
        const now = new Date();

        const days = ["Domingo", "Lunes", "Martes", "Miércoles", "Jueves", "Viernes", "Sábado"];
        const day = days[now.getDay()];

        const dayOfMonth = String(now.getDate()).padStart(2, '0');
        const month = String(now.getMonth() + 1).padStart(2, '0');
        const year = now.getFullYear();
        const currentDate = `${day} - ${dayOfMonth}/${month}/${year}`;

        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const currentTime = `${hours}:${minutes}:${seconds}`;

        document.getElementById('current-date').innerText = currentDate;
        document.getElementById('current-time').innerText = currentTime;
    }

    setInterval(updateDateTime, 1000);
    updateDateTime();
</script>
