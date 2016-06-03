// Load general packages
var gulp = require('gulp');
var pkg = require('../package.json');
var environments = require('gulp-environments');
var path = require('path');

// Load CSS specific packages
var sass = require('gulp-sass');
var postcss = require('gulp-postcss');
var sourcemaps = require('gulp-sourcemaps');
var changed = require('gulp-changed');
var connect = require('gulp-connect');

// Task variables
var src = path.join(pkg.src.scss, '**/*.scss');
var dest = pkg.build.css;

// Gulp tasks
gulp.task('styles', function() {

    var processors = [
        require('autoprefixer')({
            browsers: ['last 1 version']
        }),
        require('pixrem')(),
        require('cssnano')({ discardUnused: { fontFace: false } })
    ];

    var includePaths = [
        'bootstrap-sass-official/assets/stylesheets',
        'font-awesome-sass/assets/stylesheets',
        'reset-scss/',
        'scut/dist/'
    ].map(function(package) {
        return path.join(pkg.paths.bower, package);
    });

    return gulp.src(src)
        .pipe(changed(dest))
        // If development environment, create sourcemaps
        .pipe(environments.development(sourcemaps.init()))
        // Compile SASS
        .pipe(sass({
            includePaths: includePaths
        }).on('error', sass.logError))
        // If production environment, run postcss
        .pipe(environments.production(postcss(processors)))
        // TODO If production environment, collate media queries
        // If development environment, write sourcemaps
        .pipe(environments.development(sourcemaps.write()))
        // Write CSS to build/css
        .pipe(gulp.dest(dest));
});
