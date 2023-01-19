const mix = require('laravel-mix');

mix.setPublicPath('public')
    .js('resources/js/app.jsx', 'public')
    .react()
    .postCss('resources/css/app.css', 'public', [
        require('tailwindcss'),
    ])
    .version();