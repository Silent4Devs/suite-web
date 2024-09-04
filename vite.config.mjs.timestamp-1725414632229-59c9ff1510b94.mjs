// vite.config.mjs
import { defineConfig } from "file:///C:/laragon/www/suite-web/node_modules/vite/dist/node/index.js";
import react from "file:///C:/laragon/www/suite-web/node_modules/@vitejs/plugin-react/dist/index.mjs";
import laravel from "file:///C:/laragon/www/suite-web/node_modules/laravel-vite-plugin/dist/index.js";
var vite_config_default = defineConfig({
  plugins: [
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
});
export {
  vite_config_default as default
};
//# sourceMappingURL=data:application/json;base64,ewogICJ2ZXJzaW9uIjogMywKICAic291cmNlcyI6IFsidml0ZS5jb25maWcubWpzIl0sCiAgInNvdXJjZXNDb250ZW50IjogWyJjb25zdCBfX3ZpdGVfaW5qZWN0ZWRfb3JpZ2luYWxfZGlybmFtZSA9IFwiQzpcXFxcbGFyYWdvblxcXFx3d3dcXFxcc3VpdGUtd2ViXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ZpbGVuYW1lID0gXCJDOlxcXFxsYXJhZ29uXFxcXHd3d1xcXFxzdWl0ZS13ZWJcXFxcdml0ZS5jb25maWcubWpzXCI7Y29uc3QgX192aXRlX2luamVjdGVkX29yaWdpbmFsX2ltcG9ydF9tZXRhX3VybCA9IFwiZmlsZTovLy9DOi9sYXJhZ29uL3d3dy9zdWl0ZS13ZWIvdml0ZS5jb25maWcubWpzXCI7aW1wb3J0IHsgZGVmaW5lQ29uZmlnIH0gZnJvbSBcInZpdGVcIjtcclxuaW1wb3J0IHJlYWN0IGZyb20gXCJAdml0ZWpzL3BsdWdpbi1yZWFjdFwiO1xyXG5cclxuaW1wb3J0IGxhcmF2ZWwgZnJvbSBcImxhcmF2ZWwtdml0ZS1wbHVnaW5cIjtcclxuZXhwb3J0IGRlZmF1bHQgZGVmaW5lQ29uZmlnKHtcclxuICBwbHVnaW5zOiBbXHJcbiAgICBsYXJhdmVsKHtcclxuICAgICAgaW5wdXQ6IFtcclxuICAgICAgICBcInB1YmxpYy9jc3MvYXBwLmNzc1wiLFxyXG4gICAgICAgIFwicHVibGljL2Nzcy9nbG9iYWwvc3R5bGUuY3NzXCIsXHJcbiAgICAgICAgXCJwdWJsaWMvY3NzL2dsb2JhbC9hZG1pbi5jc3NcIixcclxuICAgICAgICBcInB1YmxpYy9jc3MvcmRzLmNzc1wiLFxyXG5cclxuICAgICAgICBcInJlc291cmNlcy9qcy9hcHAuanNcIixcclxuICAgICAgICBcInJlc291cmNlcy9qcy9hcHAuanNcIixcclxuICAgICAgICBcInB1YmxpYy9qcy9wYWdlcy9pbmRleC90ZW1wbGF0ZS1hbmFsaXNpcy1yaWVzZ29zLmpzeFwiLFxyXG4gICAgICAgIFwicHVibGljL2pzL3BhZ2VzL2luZGV4L0Zvcm11bGFzQW5hbGlzaXNSaWVzZ29zLmpzeFwiLFxyXG4gICAgICAgIFwicHVibGljL2pzL3BhZ2VzL2luZGV4L1NldHRpbmdzQW5hbGlzaXNSaWVzZ29zLmpzeFwiLFxyXG4gICAgICAgIFwicHVibGljL2pzL3BhZ2VzL2luZGV4L1RlbXBsYXRlVmlld1ByZXZBbmFsaXNpc1JpZXNnb3MuanN4XCJcclxuICAgICAgXSxcclxuICAgICAgcmVmcmVzaDogdHJ1ZVxyXG4gICAgfSlcclxuICBdXHJcbn0pO1xyXG4iXSwKICAibWFwcGluZ3MiOiAiO0FBQW9RLFNBQVMsb0JBQW9CO0FBQ2pTLE9BQU8sV0FBVztBQUVsQixPQUFPLGFBQWE7QUFDcEIsSUFBTyxzQkFBUSxhQUFhO0FBQUEsRUFDMUIsU0FBUztBQUFBLElBQ1AsUUFBUTtBQUFBLE1BQ04sT0FBTztBQUFBLFFBQ0w7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUVBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxRQUNBO0FBQUEsUUFDQTtBQUFBLFFBQ0E7QUFBQSxNQUNGO0FBQUEsTUFDQSxTQUFTO0FBQUEsSUFDWCxDQUFDO0FBQUEsRUFDSDtBQUNGLENBQUM7IiwKICAibmFtZXMiOiBbXQp9Cg==
