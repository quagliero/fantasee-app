var gulp = require('gulp');
var pkg = require('./package.json');
var environments = require('gulp-environments');
var del = require('del');
var path = require('path');
var requireDir = require('require-dir');

// Loading gulp tasks in to the registry
requireDir('./gulp/', { recurse: true });

// Basic task and alias
gulp.task('default', gulp.parallel('scripts', 'styles', 'images'));

// Clean task
// @TODO do we need a clean task?

// Deploy
// @TODO magic?
