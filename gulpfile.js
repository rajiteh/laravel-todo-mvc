process.env.DISABLE_NOTIFIER = true;
var elixir = require('laravel-elixir');

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

elixir(function(mix) {
    mix.scripts([
        "modernizr-2.8.3-respond-1.4.2.min.js",
        "jquery-1.11.2.min.js",
        "bootstrap.js",
    ], 'public/js/vendor.js')
        .coffee()
        .styles([
        'bootstrap.css',
        'bootstrap-theme.css'
    ], 'public/css/vendor.css')
        .less();


});
