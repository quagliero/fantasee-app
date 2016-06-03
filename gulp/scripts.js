// Common imports
var gulp = require('gulp');
var pkg = require('../package.json');
var path = require('path');
var gutil = require('gulp-util');

// Scripts specific packages
var modernizr = require('gulp-modernizr');
var uglify = require('gulp-uglify');
var webpack = require('webpack');
var webpackStream = require('webpack-stream');

// Scripts variables
var src = path.join(pkg.src.js, '**/*.{js,jsx}');
var dest = path.join(process.cwd(), pkg.build.js);

var webpackSettings = require('./webpack.config.js');

gulp.task('scripts', function(done) {
    return gulp.src(src)
        .pipe(webpackStream(webpackSettings, webpack))
        .on('error', function(error) {
            gutil.log(error.message);
            this.emit('end');
        })
        .pipe(gulp.dest(dest));
});

gulp.task('modernizr', function() {
    return gulp.src(path.join(pkg.src.scss, '**/*.scss'))
        .pipe(modernizr())
        .pipe(uglify())
        .pipe(gulp.dest(dest));
});
