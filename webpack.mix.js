const mix = require("laravel-mix");
const tailwindcss = require("tailwindcss");
const path = require("path");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// 'vendor/tightenco/ziggy/dist/vue' did not work as intended so app.js
// is using a custom mixin instead for the global route function.
mix.alias({
    ziggy: path.resolve("vendor/tightenco/ziggy/dist"),
});

mix.js("resources/js/stuffed.js", "public/js")
    .vue()
    .sass("resources/scss/stuffed.scss", "public/css")
    .version()
    .options({
        postCss: [tailwindcss("./tailwind.config.js")],
    })
    .webpackConfig(require("./webpack.config"));

if (mix.inProduction()) {
    mix.version();
}

if (!mix.inProduction()) {
    mix.sourceMaps();
}

mix.copy("resources/img/**/*", "public/images");
