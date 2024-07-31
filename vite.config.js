import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],

    server: {
        host: true,  // Mengizinkan host eksternal
        port: 5173,
        hmr: {
            host: 'localhost',  // Ganti dengan nama domain jika perlu
            protocol: 'ws',
            clientPort: 443
        },
    },
});


