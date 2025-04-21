import { defineConfig, loadEnv } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig(({ mode }) => {
    loadEnv(mode, process.cwd()); // You don’t need to use VITE_APP_URL directly

    return {
        base: '/', // ✅ Force relative assets or use https URL
        plugins: [
            laravel({
                input: 'resources/js/app.js',
                refresh: true,
            }),
            vue(),
        ],
        server: {
            host: true,
        },
    };
});
