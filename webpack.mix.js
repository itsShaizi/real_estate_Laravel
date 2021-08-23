const mix = require('laravel-mix');

mix.js('resources/js/app.js', 'public/js');
mix.postCss('resources/css/app.css', 'public/css', [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'),
]);
mix.postCss('resources/css/realtyhive.css', 'public/css');
