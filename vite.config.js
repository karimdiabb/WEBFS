import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        vue(),
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/css/main-front.css'  // Ensure this is last
            ],
            refresh: true,
        }),
    ],
    resolve: {
        alias: {
            '@': '/resources',
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
