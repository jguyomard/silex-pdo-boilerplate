var gulp        = require('gulp'),
    browserSync = require('browser-sync').create(),
    sass        = require('gulp-sass'),
    sourcemaps  = require('gulp-sourcemaps'),
    concat      = require('gulp-concat'),
    uglify      = require('gulp-uglify'),
    gulputil    = require('gulp-util');
    gulpif      = require('gulp-if');


/*
 * Env : use --production in prod mode
 */

var envDev = !gulputil.env.production;


/*
 * Conf
 */

var config = {
    sass : {
        src : './src/Template/static/scss/*',
        dest: './web/dist/css/',
        settings : {
            outputStyle: 'compressed'
        },
        watchsrc : [
            './src/Template/static/scss/**',
            './src/Blog/static/scss/**'
        ]
    },
    js : {
        src : [
            './src/Blog/static/js/blog.js'
        ],
        dest: './web/dist/js/',
        filename: 'app.js'
    },
    browserSync: {
        proxy: {
            target: "localhost:8080",
            middleware: function (req, res, next) {
                res.setHeader('Cache-Control', 'no-cache, no-store, must-revalidate');
                next()
            }
        }
    }
};


/*
 * Gulp Tasks
 */

gulp.task('browserSync', function () {
    browserSync.init(config.browserSync);
});

gulp.task('sass', function () {
    return gulp.src(config.sass.src)
        .pipe(gulpif(envDev, sourcemaps.init()))
        .pipe(sass(config.sass.settings))
        .pipe(gulpif(envDev, sourcemaps.write('./')))
        .pipe(gulp.dest(config.sass.dest))
        .pipe(browserSync.reload({stream:true}));
});

gulp.task('js', function () {
    return gulp.src(config.js.src)
        .pipe(gulpif(envDev, sourcemaps.init()))
        .pipe(concat(config.js.filename))
        .pipe(gulpif(envDev, sourcemaps.write()))
        .pipe(uglify())
        .pipe(gulp.dest(config.js.dest))
        .pipe(browserSync.reload({stream:true}));
});

gulp.task('build', ['sass', 'js']);

gulp.task('watch', ['browserSync'], function() {
    gulp.watch(config.sass.watchsrc, ['sass']);
    gulp.watch(config.js.src, ['js']);
});

gulp.task('default', ['build', 'watch']);
