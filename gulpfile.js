'use strict';

const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const uglify = require('gulp-uglify');
const concat = require('gulp-concat');
const sourcemaps = require('gulp-sourcemaps');
const header = require('gulp-header');
const banner = `/*!
Theme Name: anubis
Theme URI: http://***.com/
Author: Anubis
Author URI: http://***.me/
Description: Description
Version: 1.0.0
Tested up to: 5.4
Requires PHP: 5.6
License: GNU General Public License v2 or later
License URI: LICENSE
Text Domain: anubis

This theme, is licensed under the GPL.
Use it to make something cool, have fun, and share what you've learned.

*/
`;

const sassInit = () => {
	console.log('Running sassInit task');
	return gulp
	    .src('./dev/scss/**/*.scss')
		.pipe(sourcemaps.init())
	    .pipe(sass.sync({
	    	outputStyle: 'compressed',
	    	sourceComments: false
	    }).on('error', sass.logError))
		//.pipe(concat('style.css'))
		.pipe(header(banner, { })) 
		.pipe(sourcemaps.write('.'))
	    .pipe(gulp.dest('./dist/css/'));
}

const sassWatch = () => {
	gulp.watch('./dev/scss/**/*.scss', sassInit);
}

const jsInit = () => {
	return gulp
		.src('./dev/js/**/*.js')
		.pipe(sourcemaps.init())
		.pipe(uglify())
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./dist/js/'));
    
}

const jsWatch = () => {
	gulp.watch('./dev/js/**/*.js', jsInit);
}

const watchAll = () => {
	gulp.watch('./dev/scss/**/*.scss', sassInit);
	gulp.watch('./dev/js/**/*.js', jsInit);
}

exports.sassInit = sassInit;
exports.sassWatch = sassWatch;
exports.jsInit = jsInit;
exports.jsWatch = jsWatch;
exports.watchAll = watchAll;