const mix = require('laravel-mix')

mix.js('./resources/js/bootstrap/', 'resources/js/app.js', 'public/js')
    .postCss('resources/css/app.css', 'public/css')