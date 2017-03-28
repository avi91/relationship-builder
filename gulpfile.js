var elixir = require('laravel-elixir');
require('./tasks/angular.task.js');
//require('./tasks/bower.task.js');
require('laravel-elixir-livereload');

elixir(function(mix){
  mix
    .angular('./angular/','public/js/')
    .sass('./angular/**/*.sass','public/css/')
    .copy('./angular/app/**/*.html','public/views/app')
    .copy('./angular/directives/**/*.html','public/views/directives/')
    .copy('./angular/dialogs/**/*.html', 'public/views/dialogs')
    .livereload([
        'public/js/vendor.js',
        'public/js/app.js',
        'public/css/vendor.css',
        'public/css/app.css',
        'public/views/**/*.html'
    ],{liveCSS: true});
});
