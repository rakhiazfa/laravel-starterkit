import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/cube.css", "resources/js/cube.js"],
            refresh: true,
        }),
    ],
    build: {
        chunkSizeWarningLimit: 1600,
    },
    server: {
        host: "192.168.1.29",
        port: 5173,
    },
});
