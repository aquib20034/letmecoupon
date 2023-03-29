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
   .js('resources/js/app/utilities.js', 'public/build/js/app').vue()
   .sass('resources/sass/app.scss', 'public/css')
   .sass('resources/sass/app/main.scss', 'public/build/css/app')
   .sass('resources/sass/app/fonts.scss', 'public/build/css/app')
   .sass('resources/sass/app/icons.scss', 'public/build/css/app');

function findFiles(dir) {
   const fs = require('fs');
   return fs.readdirSync(dir).filter(file => {
         return fs.statSync(`${dir}/${file}`).isFile();
   });
}

function buildSass(dir, dest) {
   findFiles(dir).forEach(function (file) {
         //if ( ! file.startsWith('_')) {
            mix.sass(dir + '/' + file, dest);
         //}
   });
}

buildSass('resources/sass/app/pages', 'public/build/css/app/pages');
//buildSass('resources/sass/app/partials', 'public/build/css/app/partials');
//buildSass('resources/sass/app/components', 'public/build/css/app/components');
  
