let gulp = require('gulp');
let cleanCSS = require('gulp-clean-css');
let sass = require('gulp-sass')(require('sass'));
let rename = require('gulp-rename');
let minify = require('gulp-minify');
// let browserSync = require('browser-sync').create();
// let reload = browserSync.reload;

// watches the files and automatically updates them when save is clicked

gulp.task('watch', () => {

    // gulp.watch('assets/src/*/*.*').on("change", reload);  
    gulp.watch(['assets/src/sass/*/*.scss','assets/src/sass/*/*/*.scss'],
    gulp.parallel(['minify-sass']));

    gulp.watch(['assets/src/js/*.js'],
    gulp.parallel(['minify-js']));

});

// compresses css file

gulp.task('minify-css', () => {
  return gulp.src('assets/css/styles.css')
    .pipe(cleanCSS({compatibility: 'ie8'}))
    .pipe(rename({suffix: '.min'}))
    .pipe(gulp.dest('assets/css'));
});

// converts sass to css 

gulp.task('sass', function () {
return gulp.src('assets/src/sass/style.scss')
    .pipe(sass())
    .pipe(rename('styles.css'))
    .pipe(gulp.dest('assets/css/'));
});

// runs sass and minify-css in series

gulp.task('minify-sass', gulp.series('sass', 'minify-css'));

gulp.task('minify-js', ()=> {
    return gulp.src('assets/src/js/*.js')
    .pipe(minify())
    .pipe(gulp.dest('assets/js/'));
});