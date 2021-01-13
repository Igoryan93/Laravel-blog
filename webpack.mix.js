let mix = require('laravel-mix');

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

mix.js('resources/assets/js/app.js', 'public/js')
    .sass('resources/assets/sass/app.scss', 'public/css')
    .sass('resources/assets/sass/style.scss', 'public/css')
    .options({
        postCss: [
            require('autoprefixer')({
                browsers: [
                    'last 15 versions',
                    'last 6 iOS versions',
                    'last 6 Android versions',
                    'last 6 Safari versions',
                    'last 2 ie versions'
                ],
                grid: true
            })
        ]
    })
    .styles([
       'resources/assets/css/vendors.bundle.css',
       'resources/assets/css/app.bundle.css',
       'resources/assets/css/skins/skin-master.css',
       'resources/assets/css/fa-solid.css',
       'resources/assets/css/fa-brands.css',
       'resources/assets/css/fa-regular.css',
       'resources/assets/css/skins/skin-master.css',
       'resources/assets/css/page-login-alt.css,'
    ], 'public/css/all.css')
    .scripts([
        'resources/assets/js/vendors.bundle.js',
        'resources/assets/js/app.bundle.js',
    ], 'public/js/all.js')
    .js('resources/assets/js/customs.js', 'public/js');
