<!-- <!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'es' // Establecer el idioma en español
        });
        calendar.render();
      });
    </script>
  </head>
  <body>
    <div id="calendar"></div>
  </body>
</html> -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Asistencia Diaria') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">

                <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js"></script>
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        var calendarEl = document.getElementById('calendar');
                        var calendar = new FullCalendar.Calendar(calendarEl, {
                            initialView: 'dayGridMonth',
                            locale: 'es', // Establecer el idioma en español

                            // Habilitar la selección de un día
                            dateClick: function(info) {
                                var date = info.dateStr; // La fecha seleccionada
                                
                                // Mostrar un cuadro de texto para ingresar un recordatorio
                                var recordatorio = prompt("Ingrese un mensaje de recordatorio para el " + date);

                                if (recordatorio) {
                                    // Agregar el evento al calendario con el mensaje de recordatorio
                                    calendar.addEvent({
                                        title: recordatorio,
                                        start: date, // Fecha del recordatorio
                                        allDay: true, // Todo el día
                                        color: 'lightblue', // Color del evento
                                        textColor: 'black' // Color del texto
                                    });
                                }
                            }
                        });
                        calendar.render();
                    });
                </script>

                <div id="calendar"></div>   
                
            </div>
        </div>
    </div>
</x-app-layout>
