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

let mix = require('laravel-mix');
let path = require('path');

mix.setPublicPath(`..${path.sep}public_html`)
    .js('resources/js/app.js', 'js')
    .sass('resources/sass/app.scss', 'css');
