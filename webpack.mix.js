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

// mix.js('resources/js/app.js', 'public/js')
//     .postCss('resources/css/app.css', 'public/css', [
//         //
//     ]);

mix.options({
    fileLoaderDirs: {
        'images': 'src/mirui/img/core',
        'fonts': 'src/mirui/css/fonts',
    }
});

if (mix.inProduction()) {
    mix.version();
}

mix.postCss('resources/mirui/css/fonts/font.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/mirui.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/mirui-landing.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-aboutus.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-auth.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-contactus.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-dashboard.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-watch.css', 'src/mirui/css');

mix.js('resources/mirui/js/mirui.js', 'src/mirui/js');

// https://laravel-mix.com/docs/6.0/copying-files
mix.copyDirectory('resources/mirui/img/partners', 'public/src/mirui/img/partners');
