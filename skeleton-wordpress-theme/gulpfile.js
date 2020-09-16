const { src, dest, parallel } = require('gulp');

const gulp = require( 'gulp' );
const sass = require( 'gulp-sass' );
const concat = require( 'gulp-concat' );
const postcss = require( 'gulp-postcss' );
const autoprefixer = require( 'autoprefixer' );
const uglify = require( 'gulp-uglify' );
const babel = require( 'gulp-babel' );
const sourcemaps = require( 'gulp-sourcemaps' );
const rename = require( 'gulp-rename' );

// source files
const SOURCE = {
    styles: 'assets/css/src/**/*.scss',
    scripts: 'assets/js/src/**/*.js'
};

// compiled assets go here
const DEST = {
    styles: 'assets/css/',
    scripts: 'assets/js/'
};

function css() {
    return src( SOURCE.styles )
        .pipe( sourcemaps.init() )
        .pipe( sass({
            outputStyle: 'compressed'
        }) )
        .pipe( postcss( [
            autoprefixer()
        ] ) )
        .pipe( rename( {
            suffix: '.min'
        } ) )
        .pipe( sourcemaps.write('.') )
        .pipe( dest( DEST.styles ) )
}

function scriptsTask() {
    return src( SOURCE.scripts )
        .pipe( sourcemaps.init() )
        .pipe( babel() )
        .pipe( concat( 'scripts.min.js' ) )
        .pipe( uglify() )
        .pipe( sourcemaps.write('.') )
        .pipe( dest( DEST.scripts ) )
}

function watchTask() {
    gulp.watch( SOURCE.styles, css );
    gulp.watch( SOURCE.scripts, js );
}

const watch = gulp.parallel( watchTask );
const js = gulp.parallel( scriptsTask );

// tasks
exports.scripts = js;
exports.styles = css;
exports.watch = watch;
exports.default = parallel( css, js );
