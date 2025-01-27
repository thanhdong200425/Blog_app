import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/js/app.js", "resources/js/signIn.js", "resources/js/ask.js", "resources/js/home.js", "resources/js/signUp.js", "resources/css/app.css", "resources/css/sign_in.css", "resources/css/main/home.css", "resources/css/main/asking.css", "resources/css/main/post/list-post.css", "resources/css/main/post/post.css"],
            refresh: true,
        }),
    ],
});
