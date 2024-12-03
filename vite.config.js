import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/assets/css/main.css',
                // 'resources/assets/js/vendors/bootstrap.bundle.min.js',
                'resources/assets/js/vendors/select2.min.js',
                'resources/assets/js/vendors/perfect-scrollbar.js',
                'resources/assets/js/vendors/jquery.fullscreen.js',
                // 'resources/assets/js/vendors/chart.js',
                'resources/assets/js/main.js',
                // 'resources/assets/js/custom-chart.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        sourcemap: false, // Matikan source maps
    },
});
