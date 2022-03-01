const mix = require('laravel-mix');

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

//  mix.setPublicPath('public/src');

mix.js('resources/vendor/js/app.js', 'vendor/js')
    .postCss('resources/vendor/css/app.css', 'vendor/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

mix.postCss('resources/css/fonts/font.css', 'css');
mix.postCss('resources/css/mirui.css', 'css');
mix.postCss('resources/css/views/mirui-aboutus.css', 'css');
mix.postCss('resources/css/views/mirui-auth.css', 'css');
mix.postCss('resources/css/views/mirui-contactus.css', 'css');
mix.postCss('resources/css/views/mirui-dashboard.css', 'css');
mix.postCss('resources/css/views/mirui-watch.css', 'css');

mix.js('resources/js/mirui.js', 'js');


if (mix.inProduction()) {
    mix.version();
}
