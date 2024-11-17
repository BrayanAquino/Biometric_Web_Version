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
        <input type="text" id="qr_info" name="qr_info" class="mt-4 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" placeholder="Valor del QR" readonly>
    </div>

    <!-- Columna Derecha: Inputs -->
    <div class="bg-gray-600 dark:bg-gray-800 p-6 rounded-lg shadow-md w-1/2 ml-4">
        <h2 class="text-2xl font-semibold text-gray-200 mb-4">Detalles</h2>
        <form>
            <div class="mb-4">
                <label for="arrival-date" class="block text-gray-300">Fecha:</label>
                <input type="date" id="arrival-date" class="mt-1 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" required readonly>
            </div>
            <div class="mb-4">
                <label for="arrival-time" class="block text-gray-300">Hora de Llegada:</label>
                <input type="time" id="arrival-time" class="mt-1 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" required readonly>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-gray-300">Nombre:</label>
                <input type="text" id="name" class="mt-1 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" required readonly>
            </div>
            <div class="mb-4">
                <label for="entry-time" class="block text-gray-300">Hora de Entrada:</label>
                <input type="time" id="entry-time" class="mt-1 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" required readonly>
            </div>
            <div class="mb-4">
                <label for="help" class="block text-gray-300">Turno</label>
                <input type="text" id="help" class="mt-1 block w-full p-2 rounded bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200" value="Mañana">
            </div>
            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Enviar</button>
        </form>
    </div>
    <script>
        const setCurrentDateTime = () => {
            const now = new Date();
            const date = now.toISOString().split('T')[0]; // Formato YYYY-MM-DD
            const time = now.toTimeString().split(' ')[0].substring(0, 5); // Formato HH:MM

            document.getElementById('arrival-date').value = date;
            document.getElementById('arrival-time').value = time;
        };

        setCurrentDateTime();
    </script>
    <script>
        const setCurrentDateTime = () => {
            const now = new Date();
            const date = now.toISOString().split('T')[0]; // Formato YYYY-MM-DD
            const time = now.toTimeString().split(' ')[0].substring(0, 5); // Formato HH:MM

            document.getElementById('arrival-date').value = date;
            document.getElementById('arrival-time').value = time;
        };

        setCurrentDateTime();
    </script>
    <script type="module">
        console.log('Running')

        //crea elemento
        const video = document.createElement("video");

        //nuestro camvas
        const canvasElement = document.getElementById("qr-canvas");
        const canvas = canvasElement.getContext("2d");

        //div donde llegara nuestro canvas
        const btnScanQR = document.getElementById("btn-scan-qr");

        //lectura desactivada
        let scanning = false;

        //funcion para encender la camara
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

        //funciones para levantar las funiones de encendido de la camara
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

        //apagara la camara
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

        //callback cuando termina de leer el codigo QR
        qrcode.callback = (respuesta) => {
            if (respuesta) {
                //console.log(respuesta);
                // Swal.fire(respuesta)
                document.getElementById('qr_info').value = respuesta;
                activarSonido();
                //encenderCamara();
                cerrarCamara();

            }
        };
        //evento para mostrar la camara sin el boton
        window.addEventListener('load', (e) => {
            encenderCamara();
        })
    </script>
</div>
