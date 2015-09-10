"use strict";

var gulp = require('gulp'),
  mbf = require('main-bower-files'),
  concat = require('gulp-concat'),
  wrap = require('gulp-wrap'),
  browserify = require('gulp-browserify'),
  jshint = require('gulp-jshint'),
  less = require('gulp-less'),
  livereload = require('gulp-livereload');

gulp.task('bower', function () {  
  gulp.src(mbf({includeDev: true}).filter(function (f) { return f.substr(-2) === 'js'; }))
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest('public/js/'));
     console.log(mbf({includeDev: true})); 
});

gulp.task('browserify', function () {  
  gulp.src(['private/js/*.js'])
    .pipe(browserify())
    .pipe(gulp.dest('webroot/js/'));
});

gulp.task('jshint', function () {  
  return gulp.src(['private/js/**/*.js'])
    .pipe(jshint(process.env.NODE_ENV === 'development' ? {devel: true} : {}))
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(jshint.reporter('fail'));
});

gulp.task('bootstrap', function () {  
  gulp.src('bower_components/bootstrap/fonts/*')
    .pipe(gulp.dest('webroot/fonts/vendor/bootstrap/'));
});

gulp.task('less', function () {  
  gulp.src('private/less/blog_theme.less')
    .pipe(less({
      compress: process.env.NODE_ENV === 'development' ? false : true
    }))
    .pipe(gulp.dest('webroot/css/'));
});

gulp.task('watch', ['browserify', 'less'] ,function () {  
  gulp.watch('private/js/**/*.js', [ 'browserify' ]);
  gulp.watch('private/less/**/*.less', [ 'less' ]);
  livereload.listen();
  gulp.watch('webroot/**').on('change', livereload.changed);
});
