var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    var bootstrapPath = 'node_modules/bootstrap-sass/assets';
    var jQueryPath = 'node_modules/jquery/dist';
    mix.sass([
                'app.scss'
            ], 'public/assets/css')
            .copy(bootstrapPath + '/javascripts/bootstrap.min.js', 'public/assets/js')
            .copy(jQueryPath + '/jquery.min.js', 'public/assets/js');
});
