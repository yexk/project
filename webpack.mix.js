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

// mix.js('resources/assets/js/app.js', 'public/js')
//    .sass('resources/assets/sass/app.scss', 'public/css');

mix
	.copy('node_modules/jquery/dist/jquery.js','public/common/js/jquery.js')
	.copy('node_modules/bootstrap/dist/css/bootstrap.css','public/common/css/bootstrap.css')
	.copy('node_modules/bootstrap/dist/fonts/glyphicons-halflings-regular.eot','public/common/fonts/glyphicons-halflings-regular.eot')
	.copy('node_modules/bootstrap/dist/fonts/glyphicons-halflings-regular.svg','public/common/fonts/glyphicons-halflings-regular.svg')
	.copy('node_modules/bootstrap/dist/fonts/glyphicons-halflings-regular.ttf','public/common/fonts/glyphicons-halflings-regular.ttf')
	.copy('node_modules/bootstrap/dist/fonts/glyphicons-halflings-regular.woff','public/common/fonts/glyphicons-halflings-regular.woff')
	.copy('node_modules/bootstrap/dist/fonts/glyphicons-halflings-regular.woff2','public/common/fonts/glyphicons-halflings-regular.woff2')
	.copy('node_modules/bootstrap/dist/js/bootstrap.js','public/common/js/bootstrap.js')
;