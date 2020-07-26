const gulp = require('gulp'),
	sass = require('gulp-sass'), //css
    autoprefixer = require('gulp-autoprefixer'),
    cleanCSS  = require ('gulp-clean-css'),// удаляет неспользуемые
	terser = require('gulp-terser'), // js
    concat = require('gulp-concat'), // 2 => 1
    tinify = require('gulp-tinify'),
    watch = require('gulp-watch');

gulp.task('sass', function(){
    return gulp.src([
        './css/style.scss',
        './css/media.scss'
        ])
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(autoprefixer())
        .pipe(concat('style.css')) 
        .pipe(gulp.dest('../release/css'));
});
gulp.task('js', function(){
    return gulp.src([
        // 'js/ajax.js',
        'js/script.js',
        ])
        .pipe(terser())
        .pipe(concat('script.js'))
        .pipe(gulp.dest('../release/js'));
});
gulp.task('watch', function () {
    watch("css/style.scss", gulp.series('sass'));
    watch("css/media.scss", gulp.series('sass'));
    watch("css/basic.scss", gulp.series('sass'));

    watch("js/script.js", gulp.series('js'));
    // watch("js/ajax.js", gulp.series('js'));
});





gulp.task('css-modules', function () {
    return gulp.src([
        'app/bootstrap.css',
        'app/slick-1.8.1/slick/slick.scss',
        'app/slick-1.8.1/slick/slick-theme.scss',
        // 'app/lightbox2/dist/css/lightbox.css'
    ])
        .pipe(sass({outputStyle: 'compressed'}).on('error', sass.logError))
        .pipe(cleanCSS({compatibility: 'ie8'}))
        .pipe(autoprefixer())
        .pipe(concat('modules.css'))
        .pipe(gulp.dest('../release/app'));
});
gulp.task('js-modules', function () {
    return gulp.src([
        'app/script/jquery-3.4.1.min.js',
        'app/script/bootstrap.min.js',
        'app/script/slick.js',
        // 'app/script/lightbox.js',
    ])
        .pipe(terser())
        .pipe(concat('modules.js'))
        .pipe(gulp.dest('../release/app'));
});

gulp.task('img', function () {
    return gulp.src('./imgs/*.*')
        .pipe(tinify('FqgVtd2kTYFDKN4MtLwML4PMlc1gPcYX'))
        .pipe(gulp.dest('../release/img'));
});

// gulp.task('fonts', function () {
//     return gulp.src('css/fonts/*.otf')
//         .pipe(gulp.dest('./buld/css/fonts'));
// });
gulp.task('full', gulp.series(
    'js-modules',
    'css-modules',
    'js',
    'sass',
    'img',
    // 'fonts',
));


