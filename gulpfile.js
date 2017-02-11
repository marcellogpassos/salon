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

	gulp.src(src_dir + "chart.js/dist/Chart.min.js")
		.pipe(gulp.dest(dst_dir + "chart.js"));
	gulp.src(src_dir + "chart.js/dist/Chart.bundle.min.js")
		.pipe(gulp.dest(dst_dir + "chart.js"));

	gulp.src(src_dir + "dropify/dist/**")
		.pipe(gulp.dest(dst_dir + "dropify"));

	gulp.src(src_dir + "pickadate/lib/**")
		.pipe(gulp.dest(dst_dir + "pickadate"));

	gulp.src(src_dir + "jquery-timepicker-wvega/jquery.timepicker.js")
		.pipe(gulp.dest(dst_dir + "jquery-timepicker-wvega"));
	gulp.src(src_dir + "jquery-timepicker-wvega/jquery.timepicker.css")
		.pipe(gulp.dest(dst_dir + "jquery-timepicker-wvega"));

	gulp.src(src_dir + "fullcalendar/dist/**")
		.pipe(gulp.dest(dst_dir + "fullcalendar"));

	gulp.src(src_dir + "moment/min/*")
		.pipe(gulp.dest(dst_dir + "moment"));

	gulp.src(src_dir + "materialize/dist/**")
		.pipe(gulp.dest(dst_dir + "materialize"));

});