// gulp
var gulp = require('gulp');

// plugins
var uglify = require('gulp-uglify');
var minifyCSS = require('gulp-minify-css');
var runSequence = require('run-sequence').use(gulp);
var minifyHtml = require('gulp-minify-html');
var ngTemplate = require('gulp-ng-template');
var gp_concat = require('gulp-concat');

// tasks
gulp.task('minify-css', function() {
    var opts = {comments:true,spare:true};
    gulp.src(['./app/**/*.css', '!./app/bower_components/**'])
        .pipe(minifyCSS(opts))
        .pipe(gulp.dest('./web/css/'))
});
gulp.task('templates', function() {
    gulp.src('./ngApp/templates/**/*.html')
        .pipe(minifyHtml({empty: true, quotes: true}))
        .pipe(ngTemplate({
            moduleName: 'SymfonyAppTpl',
            standalone: true,
            filePath: 'templates.js'
        }))
        .pipe(gulp.dest('./ngApp/'))
});
gulp.task('minify-js', function() {
    gulp.src(['./ngApp/**/*.js'])
        .pipe(gp_concat('app.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./web/js/'))
});

// default task
gulp.task('default',
    ['lint', 'connect']
);
gulp.task('build', function() {
    runSequence(
        ['minify-css','templates', 'minify-js']
    );
});