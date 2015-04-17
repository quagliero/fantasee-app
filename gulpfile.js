var elixir = require('laravel-elixir');
var browserSync = require('laravel-elixir-browser-sync');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */
var paths = {
  'bootstrap': './public/bower_components/bootstrap-sass-official/assets/',
  'fontAwesome': './public/bower_components/font-awesome-sass/assets/'
};

elixir(function(mix) {
  mix.sass('app.scss', 'public/css', {
    includePaths: [
      paths.bootstrap + 'stylesheets/',
      paths.fontAwesome + 'stylesheets/'
    ]
  });

  mix.browserSync([
    'app/**/*',
    'public/**/*',
    'resources/views/**/*'
  ], {
    proxy: 'fantasee.app',
    reloadDelay: 500
  });
});
