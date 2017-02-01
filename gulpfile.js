let elixir = require('laravel-elixir');

stylesPath = 'public/css/';
scriptsPath = 'public/js/';

elixir.config.css.outputFolder = stylesPath;
elixir.config.js.outputFolder = scriptsPath;
elixir.config.sourcemaps = false;

elixir(function (mix) {
    mix.copy('resources/assets/js/*.*', scriptsPath)
        .copy('resources/assets/css/*.*', stylesPath)
        .scripts([
            'jquery-3.1.1.min.js',
            'bootstrap.min.js',
            'script.js'
        ], scriptsPath + 'main.js');
});
