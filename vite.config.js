import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/qrCode.min.js',
                'resources/js/qrDeteccion.js',
                'resources/sound/sonido.mp3',
            ],
            refresh: true,
        }),
    ],
});
