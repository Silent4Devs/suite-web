import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

import laravel from "laravel-vite-plugin";
export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/sass/app.scss",
                "resources/js/app.js",
                "public/js/pages/index/template-analisis-riesgos.jsx",
                "public/js/pages/index/FormulasAnalisisRiesgos.jsx",
                "public/js/pages/index/SettingsAnalisisRiesgos.jsx",
                "public/js/pages/index/TemplateViewPrevAnalisisRiesgos.jsx",
            ],
            refresh: true,
        }),
    ],
});
