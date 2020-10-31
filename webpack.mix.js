const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

if (mix.inProduction()) {
    mix.version();
}

mix.js('resources/js/app.js', 'public/js')
   .js('resources/js/custom.js', 'public/js/custom.min.js')
   .js('resources/js/sidebarmenu.js', 'public/js/sidebarmenu.min.js')
   .js('resources/js/waves.js', 'public/js/waves.min.js')
   .sass('resources/sass/auth.scss', 'public/css')
   .sass('resources/sass/auth_rtl.scss', 'public/css')
   .sass('resources/sass/style.scss', 'public/css/style.min.css')
   .sass('resources/sass/rtl.scss', 'public/css/rtl.css')
