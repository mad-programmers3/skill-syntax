const path = require("path");

const mix = require('laravel-mix');

mix.alias({
    '@': path.join(__dirname, 'resources/js')
});

mix.js('resources/vue-app/backend/js/app.js', 'public/vue-app/backend/js').vue();
mix.sass('resources/vue-app/backend/css/app.scss', 'public/vue-app/backend/css');