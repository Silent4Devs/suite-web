import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

import laravel from "laravel-vite-plugin";
export default defineConfig({
  plugins: [
    react(),
    laravel({
      input: [
        "public/css/app.css",
        "public/css/global/style.css",
        "public/css/global/admin.css",
        "public/css/rds.css",
        "public/css/escuela/certificados.css",

        "resources/sass/app.scss",
        "resources/js/app.js",
        "public/js/pages/index/template-analisis-riesgos.jsx",
        "public/js/pages/index/FormulasAnalisisRiesgos.jsx",
        "public/js/pages/index/SettingsAnalisisRiesgos.jsx",
        "public/js/pages/index/TemplateViewPrevAnalisisRiesgos.jsx",

        // modulos css
        "resources/css/centroAtencion.css",
        "resources/js/app_teanet.js",
        "resources/css/app.css"
      ],
      refresh: true
    })
  ]
});
