import { defineConfig } from 'vite';
import react from '@vitejs/plugin-react';

import laravel from 'laravel-vite-plugin';
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'public/js/pages/index/template-analisis-riesgos.jsx',
            ],
            refresh: true,
        }),
        react(),
    ],
});
