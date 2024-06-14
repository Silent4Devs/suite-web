import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
  plugins: [
    laravel({
      input: [
            "public/css/app.css",
            "public/css/style.css",
            "public/css/admin.css",
            "public/css/rds.css",

            "resources/js/app.js",
        ],
      refresh: true
    })
  ]
});
