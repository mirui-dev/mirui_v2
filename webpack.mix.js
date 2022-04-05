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

mix.options({
    fileLoaderDirs: {
        'images': 'src/mirui/images',
        'fonts': 'src/mirui/css/fonts',
    }
});

mix.js('resources/vendor/js/app.js', 'src/vendor/js')
    .postCss('resources/vendor/css/app.css', 'src/vendor/css', [
        require('postcss-import'),
        require('tailwindcss'),
    ]);

mix.postCss('resources/mirui/css/fonts/font.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/mirui.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-aboutus.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-auth.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-contactus.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-dashboard.css', 'src/mirui/css');
mix.postCss('resources/mirui/css/views/mirui-watch.css', 'src/mirui/css');

mix.js('resources/mirui/js/mirui.js', 'src/mirui/js');


if (mix.inProduction()) {
    mix.version();
}
