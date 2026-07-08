import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

// Mengompilasi stylesheet dan JavaScript utama serta memuat ulang Blade saat development.
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
