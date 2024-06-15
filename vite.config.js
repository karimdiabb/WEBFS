import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';



export default defineConfig({
    plugins: [
        
        vue(),
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js', 'resources/css/main.css'],
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
