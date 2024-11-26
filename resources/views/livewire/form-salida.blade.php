<div class="flex w-full max-w-4xl">
    <!-- Columna Izquierda: Escáner QR -->
    <div class="bg-gray-500 dark:bg-gray-900 p-6 rounded-lg shadow-md w-1/2 text-center">
        <h2 class="text-2xl font-semibold text-gray-800 dark:text-white mb-4">Escanear Código QR</h2>
        <div class="flex justify-center mb-4">
            <a id="btn-scan-qr" href="#">
                <img src="https://dab1nmslvvntp.cloudfront.net/wp-content/uploads/2017/07/1499401426qr_icon.svg" class="w-24">
            </a>
        </div>
        <canvas hidden id="qr-canvas" class="img-fluid"></canvas>
        <div class="mt-4">
            <button id="btn-close" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600 hidden">Cerrar Cámara</button>
        </div>
        <input type="hidden" id="qr_info" name="qr_info" class="mt-4 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" placeholder="Valor del QR" wire:model.live="qr_info">
    </div>

    <!-- Columna Derecha: Inputs -->
    <div class="bg-gray-600 dark:bg-gray-800 p-6 rounded-lg shadow-md w-1/2 ml-4">
        <h2 class="text-2xl font-semibold text-gray-200 mb-4">Detalles</h2>
        <form method="POST" action="{{ route('asistencia.update') }}">
            @csrf
            <div class="mb-4">
                <label for="arrival-date" class="block text-gray-300">Fecha:</label>
                <input type="date" id="arrival-date" name="fecha" class="mt-1 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" required readonly>
            </div>
            <div class="mb-4">
                <label for="arrival-time" class="block text-gray-300">Hora de Salida:</label>
                <input type="time" id="arrival-time" name="hora_entrada" class="mt-1 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" required readonly>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-300">DNI:</label>
                <input type="text" id="name" name="dni" class="mt-1 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" readonly>
            </div>
            <div class="mb-4">
                <label for="help" class="block text-gray-300">Turno</label>
                <input type="text" id="help" name="shift" class="mt-1 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="Mañana" readonly>
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Enviar</button>
        </form>
    </div>

    <div id="error-modal" class="fixed inset-0 bg-gray-800 bg-opacity-50 flex justify-center items-center hidden">
        <div class="bg-white dark:bg-gray-900 p-6 rounded-lg w-1/3 text-center">
            <button id="close-modal" class="absolute top-2 right-2 text-gray-500 dark:text-gray-200 hover:text-gray-700 dark:hover:text-gray-300">&times;</button>
            <h2 class="text-xl font-semibold text-red-500">¡Ocurrió un error!</h2>
            <p class="text-gray-600 dark:text-gray-300">Usted no es apto para marcar la salida aún.</p>
        </div>
    </div>

    <script>
        // Mostrar el modal con el mensaje de error
        const showModal = (message) => {
            const modal = document.getElementById('error-modal');
            const errorMessage = modal.querySelector('p');
            errorMessage.textContent = message;
            modal.classList.remove('hidden');
        };

        // Cerrar el modal
        const closeModal = () => {
            const modal = document.getElementById('error-modal');
            modal.classList.add('hidden');
        };

        // Botón para cerrar el modal
        const closeModalButton = document.getElementById('close-modal');
        closeModalButton.addEventListener('click', closeModal);

        // Mostrar el modal si hay un error
        @if (session('error'))
            showModal("{{ session('error') }}");
        @endif
    </script>

    <script>
        const setCurrentDateTimeAndShift = () => {
            const now = new Date();
            const date = now.toISOString().split('T')[0]; 
            const time = now.toTimeString().split(' ')[0].substring(0, 5); 
    
            document.getElementById('arrival-date').value = date;
            document.getElementById('arrival-time').value = time;
    
            // Determinar el turno
            const hour = now.getHours();
            let shift = '';
    
            if (hour >= 4 && hour < 12) {
                shift = 'Mañana';
            } else if (hour >= 12 && hour < 19) {
                shift = 'Tarde';
            } else {
                shift = 'Noche';
            }
    
            // Asignar el turno al input
            document.getElementById('help').value = shift;
        };
    
        setCurrentDateTimeAndShift();
    </script>
    <script>
        const setCurrentDateTime = () => {
            const now = new Date();
            const date = now.toISOString().split('T')[0];
            const time = now.toTimeString().split(' ')[0].substring(0, 5); 

            document.getElementById('arrival-date').value = date;
            document.getElementById('arrival-time').value = time;
        };

        setCurrentDateTime();
    </script>
    <script type="module">
        console.log('Running')
    
        // crea el elemento
        const video = document.createElement("video");
    
        // nuestro canvas
        const canvasElement = document.getElementById("qr-canvas");
        const canvas = canvasElement.getContext("2d");
    
        // div donde llegará nuestro canvas
        const btnScanQR = document.getElementById("btn-scan-qr");
    
        // lectura desactivada
        let scanning = false;
    
        // función para encender la cámara
        const encenderCamara = () => {
            navigator.mediaDevices
                .getUserMedia({
                    video: {
                        facingMode: "environment"
                    }
                })
                .then(function(stream) {
                    scanning = true;
                    btnScanQR.hidden = true;
                    canvasElement.hidden = false;
                    video.setAttribute("playsinline", true);
                    video.srcObject = stream;
                    video.play();
                    tick();
                    scan();
                });
        };
    
        // funciones para levantar las funciones de encendido de la cámara
        function tick() {
            canvasElement.height = video.videoHeight;
            canvasElement.width = video.videoWidth;
            canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
    
            scanning && requestAnimationFrame(tick);
        }
    
        function scan() {
            try {
                qrcode.decode();
            } catch (e) {
                setTimeout(scan, 300);
            }
        }
    
        // apagar la cámara
        const cerrarCamara = () => {
            video.srcObject.getTracks().forEach((track) => {
                track.stop();
            });
            canvasElement.hidden = true;
            btnScanQR.hidden = false;
        };
    
        const activarSonido = () => {
            var audio = document.getElementById('audioScaner');
            audio.play();
        }
    
        qrcode.callback = (respuesta) => {
            if (respuesta) {
                // Dividir la respuesta usando el separador "/"
                const partes = respuesta.split('/');

                // Asignar el primer valor (DNI) al campo correspondiente
                const dniInput = document.getElementById('name'); // Campo de DNI
                dniInput.value = partes[0]; // Extraer el número antes del "/"

                // Asignar el valor completo del QR al campo qr_info
                const qrInfoInput = document.getElementById('qr_info');
                qrInfoInput.value = respuesta; // Actualiza el input con el valor completo del QR

                activarSonido();

                // Cerrar la cámara
                cerrarCamara();
            }
        };

    
        // evento para mostrar la cámara sin el botón
        window.addEventListener('load', (e) => {
            encenderCamara();
        });
    </script>
</div>
