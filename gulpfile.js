var gulp = require('gulp');

var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var rename = require('gulp-rename');
var gutil = require('gulp-util');
var clean = require('gulp-clean');
var minifyCss = require('gulp-minify-css');

var vendorPath = './src/assets/vendor';
var buildPath = './src/assets/build/';

var vendorScripts = [
  'jquery-ui-1.11.4.custom/jquery-ui.js',
  'momentjs/moment-with-locales.min.js',

  'bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js',
  'jQuery-File-Upload-9.11.0/js/jquery.iframe-transport.js',
  'jQuery-File-Upload-9.11.0/js/jquery.fileupload.js',
  'jquery-minicolors-2.1.12/jquery.minicolors.js',
  'select2/js/select2.js',
  'magnific-popup/jquery.magnific-popup.js',
  'ace/src-noconflict/ace.js',

  'leaflet-0.7.5/leaflet-src.js',

  'leaflet-plugins/layer/tile/Bing.js',
  'leaflet-plugins/layer/tile/Google.js',
  'leaflet-plugins/layer/tile/Yandex.js'
].map(function(file){
  return [vendorPath, file].join('/');
});

var vendorStyles = [
  'bootstrap-datetimepicker/css/bootstrap-datetimepicker.css',
  'jQuery-File-Upload-9.11.0/css/jquery.fileupload.css',

  'jquery-minicolors-2.1.12/jquery.minicolors.css', // file
  'select2/css/select2.css',
  'select2/css/select2-bootstrap.min.css',
  'magnific-popup/magnific-popup.css',

  'leaflet-0.7.5/leaflet.css'
].map(function(file){
  return [vendorPath, file].join('/');
});

gulp.task('default', ['build']);


gulp.task('clean', function () {

  return gulp.src(buildPath, {read: false})
    .pipe(clean())
    .on('error', gutil.log);
});

gulp.task('build', ['clean'], function() {

  gulp.src(vendorScripts)
    .pipe(concat('vendor.js'))
    .pipe(gulp.dest(buildPath + 'js/'))
    .pipe(uglify())
    .pipe(rename('vendor.min.js'))
    .pipe(gulp.dest(buildPath + 'js/'))
    .on('error', gutil.log);

  gulp.src('./src/assets/js/*')
    .pipe(concat('scripts.js'))
    .pipe(gulp.dest(buildPath + 'js/'))
    .pipe(uglify())
    .pipe(rename('scripts.min.js'))
    .pipe(gulp.dest(buildPath + 'js/'))
    .on('error', gutil.log);

  gulp.src(vendorStyles)
    .pipe(concat('vendor.css'))
    .pipe(gulp.dest(buildPath + 'css/'))
    .pipe(minifyCss())
    .pipe(rename('vendor.min.css'))
    .pipe(gulp.dest(buildPath + 'css/'))
    .on('error', gutil.log);

  gulp.src('./src/assets/css/*')
    .pipe(concat('style.css'))
    .pipe(gulp.dest(buildPath + 'css/'))
    .pipe(minifyCss())
    .pipe(rename('style.min.css'))
    .pipe(gulp.dest(buildPath + 'css/'))
    .on('error', gutil.log);

  gulp.src('./src/assets/img/*')
    .pipe(gulp.dest(buildPath + 'img/'))
    .on('error', gutil.log);


  gulp.src(vendorPath + '/jquery-minicolors-2.1.12/jquery.minicolors.png')
    .pipe(gulp.dest(buildPath + 'css/'));
});