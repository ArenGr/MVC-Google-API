const gulp = require('gulp');
const concat = require('gulp-concat');
const uglify = require('gulp-uglify');

gulp.task('scripts', function() {
    return gulp.src('./resources/js/*.js')
        .pipe(concat('bundle.min.js'))
        .pipe(uglify())
        .pipe(gulp.dest('./resources/dist/js'));
});

gulp.task('default', gulp.series('scripts'));
