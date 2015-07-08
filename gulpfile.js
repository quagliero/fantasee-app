// eff elixir
var gulp = require('gulp');
var sass = require('gulp-sass');
var browserSync = require('browser-sync').create();

// Proxy Server + watching scss and blade files
gulp.task('serve', ['sass'], function() {

    browserSync.init({
        proxy: "fantasee.app"
    });

    gulp.watch("resources/assets/sass/**/*.scss", ['sass']);
    gulp.watch("resources/views/*/**.blade.php").on('change', browserSync.reload);
});

// Compile sass into CSS & auto-inject into browsers
gulp.task('sass', function() {
    return gulp.src("resources/assets/sass/**/*.scss")
        .pipe(sass({
          includePaths: [
            './public/bower_components/bootstrap-sass-official/assets/stylesheets',
            './public/bower_components/font-awesome-sass/assets/stylesheets'
          ]
        }).on('error', sass.logError))
        .pipe(gulp.dest("public/css"))
        .pipe(browserSync.stream());
});

gulp.task('default', ['serve']);
