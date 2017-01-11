const elixir = require('laravel-elixir');

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

elixir(mix => {
    mix.sass('dependencies.scss') //assumes sass assets folder
       .sass('light.scss')
       .sass('dark.scss')
       .sass('reddit.sass')
       .browserify('dependencies.js') //assumes js assets folder
});
