import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig(({ mode }) => {
    const env = loadEnv(mode, process.cwd(), '');

    return {
        // Force HTTPS for production
        base: mode === 'production' ? 'https://todo-ahmad-production.up.railway.app/' : '/',
        plugins: [
            laravel({
                input: 'resources/js/app.js',
                refresh: true,
            }),
            vue(),
        ],
        server: {
            host: true, // Required for Docker/Railway
        },
    };
});
