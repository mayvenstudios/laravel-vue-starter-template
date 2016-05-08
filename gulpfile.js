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

    mix.less('app.less','public/css/app.css');

    mix.scripts([
        'plugins/modernizr.js',
        'plugins/jquery.js',
        'plugins/jquery.pjax.js',
        'plugins/vue.js',
        'plugins/*.js'
    ], 'public/js/vendor.js');

    //mix.browserify('app.js','public/js/app.js');

    mix.version([
        'public/css/app.css',
        //'public/js/app.js',
        //'public/js/vendor.js'
    ]);
});
