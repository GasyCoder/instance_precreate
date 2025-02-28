import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import path from 'path';
import tailwindcss from 'tailwindcss';
import autoprefixer from 'autoprefixer';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: [
                'resources/routes/**',
                'routes/**',
                'resources/views/**',
                'resources/js/**',
                'resources/css/**',
            ],
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    css: {
        postcss: {
            plugins: [
                tailwindcss(),
                autoprefixer(),
            ],
        },
    },
    resolve: {
        alias: {
            '@': path.resolve(__dirname, './resources/js'),
            '@assets': path.resolve(__dirname, './public/assets'),
            '~': path.resolve(__dirname, './resources'),
            'vue': 'vue/dist/vue.esm-bundler.js',
            'alpinejs': 'alpinejs'
        },
    },
    build: {
        chunkSizeWarningLimit: 1600,
        rollupOptions: {
            output: {
                manualChunks(id) {
                    if (id.includes('node_modules')) {
                        return 'vendor';
                    }
                },
            },
        },
    },
    optimizeDeps: {
        include: [
            'vue',
            'axios',
            'lodash',
            '@headlessui/vue',
            'nouislider',
            'swiper',
            'node-waves',
        ],
    },
    server: {
        https: false,
        host: true,
        port: 5173,
        hmr: {
            host: 'localhost',
        },
    },
});
