// Load general packages
var gulp = require('gulp');
var pkg = require('../package.json');
var path = require('path');

// Browser-Sync plugins
var browserSync = require('browser-sync');
var webpack = require('webpack');
var webpackDevMiddleware = require('webpack-dev-middleware');
var webpackHotMiddleware = require('webpack-hot-middleware');

var webpackSettings = require('./webpack.config.js');
var bundler = webpack(webpackSettings);


gulp.task('serve', gulp.parallel(function() {
    gulp.watch(path.join(pkg.src.scss, '**/*.scss'), gulp.parallel('styles'));
}, function() {
    browserSync({
        proxy: {
          target: 'fantasee.app',
          middleware: [
            webpackDevMiddleware(bundler, {
              publicPath: webpackSettings.output.publicPath,
              stats: { colors: true }
            }),
            webpackHotMiddleware(bundler)
          ]
        },
        files: [pkg.build.css + '**/*.css', pkg.paths.templates + '**/*.blade.php']
    });
}));

// Aliases
gulp.task('watch', gulp.parallel(['serve']));
gulp.task('connect', gulp.parallel(['serve']));
gulp.task('run', gulp.parallel(['serve']));
