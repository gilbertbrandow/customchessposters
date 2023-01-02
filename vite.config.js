import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    server: {
        hmr: {
            host: '0.0.0.0',
        },
        watch: {
            usePolling: true
        }
    },
    plugins: [
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resource/scss/app.scss', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
});
