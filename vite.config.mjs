import { defineConfig } from "vite";
import react from "@vitejs/plugin-react";

import laravel from "laravel-vite-plugin";
export default defineConfig({
<<<<<<< HEAD
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
=======
  plugins: [
    react(),
    laravel({
      input: [
        "public/css/app.css",
        "public/css/global/style.css",
        "public/css/global/admin.css",
        "public/css/rds.css",

        "resources/js/app.js",
        "resources/js/app.js",
        "public/js/pages/index/template-analisis-riesgos.jsx",
        "public/js/pages/index/FormulasAnalisisRiesgos.jsx",
        "public/js/pages/index/SettingsAnalisisRiesgos.jsx",
        "public/js/pages/index/TemplateViewPrevAnalisisRiesgos.jsx"
      ],
      refresh: true
    })
  ]
>>>>>>> f6b1792f7727ae93475b72414f9ea514b37ad056
});
