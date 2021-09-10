const appname = 'sorce';
const gulp = require('gulp');
const sass = require('gulp-sass')(require('node-sass'));
const del = require('del');
const babel = require("gulp-babel")
const plumber = require("gulp-plumber")

gulp.task('styles', () => {
    return gulp.src('theme/src/scss/**/*.scss')
        .pipe(sass().on('error', sass.logError))
        .pipe(gulp.dest('theme/dist/css/'));
});

gulp.task('clean', () => {
    return del([
        'theme/dist/css/sorce.css',
    ]);
});
gulp.task('footer', () => {
    return gulp.src('theme/src/js/'+appname+'_footer.js')
      // Stop the process if an error is thrown.
      .pipe(plumber())
      // Transpile the JS code using Babel's preset-env.
      .pipe(
        babel({
          presets: [
            [
              "@babel/env",
              {
                modules: false
              }
            ]
          ]
        })
      )
      // Save each component as a separate file in dist.
      .pipe(gulp.dest('theme/dist/js/'));
});
gulp.task('app', () => {
    return gulp.src('theme/src/js/'+appname+'_js.js')
      // Stop the process if an error is thrown.
      .pipe(plumber())
      // Transpile the JS code using Babel's preset-env.
      .pipe(
        babel({
          presets: [
            [
              "@babel/env",
              {
                modules: false
              }
            ]
          ]
        })
      )
      // Save each component as a separate file in dist.
      .pipe(gulp.dest('.theme/dist/js/'))
});
function defaultTask(cb) {
  cb();
}
gulp.task('buildjs', (done) =>{
    gulp.series(['footer', 'app'])(done);
});

gulp.task('watch', () => {
    gulp.watch('theme/src/**/*.scss', (done) => {
        gulp.series(['clean', 'styles'])(done);
    });
    gulp.watch('theme/src/**/'+appname+'_footer.js', (done)=>{
        gulp.series(['footer'])(done);
    });
    gulp.watch('theme/src/**/'+appname+'_js.js', (done)=>{
        gulp.series[('app')](done);
    });
    
});

gulp.task('default', gulp.series(['clean', 'styles']));

exports.default = defaultTask
