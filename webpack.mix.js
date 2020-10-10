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

mix.js('resources/js/app.js', 'public/js')
    .copy('resources/css/progress-bar.css', 'public/css')
    .sass('resources/sass/about.scss', 'public/css')
    .sass('resources/sass/account.scss', 'public/css')
    .sass('resources/sass/admin.scss', 'public/css')
    .sass('resources/sass/app.scss', 'public/css')
    .sass('resources/sass/faq.scss', 'public/css')
    .sass('resources/sass/mail.scss', '../resources/views/vendor/mail/html/themes/default.css')
    .sass('resources/sass/top.scss', 'public/css');
