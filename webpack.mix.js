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


mix.js('resources/js/app.js', 'public/js')
    .js('resources/js/productDelete.js', 'public/js')
    .js('resources/js/productSearch.js', 'public/js')
    .js('resources/js/productList.js', 'public/js')
    .js('resources/js/productSort.js', 'public/js')
    .js('resources/js/productMakers.js', 'public/js')
    .js('resources/js/productPrice.js', 'public/js')
    .js('resources/js/productStock.js', 'public/js')
    .sourceMaps()
    .autoload({
        "jquery": ['$', 'window.jQuery'],
    });