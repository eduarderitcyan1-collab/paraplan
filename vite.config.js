import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/about.css",
                "resources/css/gallery.css",
                "resources/css/welcome.css",
                "resources/css/training.css",
                "resources/css/marshruty.css",
                "resources/css/stati.css",
                "resources/js/app.js",
                "resources/js/flypoint-swiper.js",
                "resources/js/gallery-swiper.js",
                "resources/js/gallery.js",
                "resources/js/reviews-swiper.js",
                "resources/js/sertificate-swiper.js",
                "resources/js/service-swiper.js",
                "resources/js/tarif-swiper.js",
                "resources/js/team-swiper.js",
                "resources/js/whyUs-swiper.js",
            ],
            refresh: true,
        }),
    ],
});
