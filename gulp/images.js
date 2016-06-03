// Load general packages
var gulp = require('gulp');
var pkg = require('../package.json');
var environments = require('gulp-environments');
var path = require('path');
var changed = require('gulp-changed');
var gutil = require('gulp-util');

// Image specific plugins
var imagemin = require('gulp-imagemin');
var webp = require('gulp-webp');

// Images variables
var src = path.join(pkg.src.images, '**/*.{png,jpg,jpeg,gif,svg}');
var dest = pkg.build.images;


// Image tasks
gulp.task('images:webp', function() {
    return gulp.src(path.join(dest, '**/*.{png,jpg,jpeg,gif,svg}'))
        .pipe(environments.production(webp()))
        .pipe(gulp.dest(dest));
});

gulp.task('images:optimize', function() {
    return gulp.src(src)
        .pipe(environments.production(imagemin()))
        .pipe(gulp.dest(dest));
});

gulp.task('images', gulp.series('images:optimize'));
