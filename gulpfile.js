// var elixir = require('laravel-elixir');

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

// elixir(function(mix) {
//     mix.sass('app.scss');
// });

var gulp = require('gulp');

gulp.task('default', function () {

    var src_dir = "./bower_components/";
    var dst_dir = "./public/lib/";

    gulp.src(src_dir + "jquery.maskedinput/dist/*")
        .pipe(gulp.dest(dst_dir + "jquery.maskedinput"));

    gulp.src(src_dir + "jquery-maskmoney/dist/jquery.maskMoney.min.js")
        .pipe(gulp.dest(dst_dir + "jquery-maskmoney"));

});