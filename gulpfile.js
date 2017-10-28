var basePaths = {
	scss: './sass/',
	js: './js/',
	img: './images/',
	fonts: './fonts/',
	node: './node_modules/',
	src: './src/',
};

var gulp = require('gulp')
var autoprefixer = require('autoprefixer');
var image = require('gulp-image');
var jshint = require('gulp-jshint');
var postcss = require('gulp-postcss');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var newer = require('gulp-newer');
var del = require('del');

gulp.task('css', function() {
	return gulp.src(basePaths.scss + '**/*.scss')
	//.pipe(sourcemaps.init())
	.pipe(sass({
		outputStyle: 'expanded',
		indentType: 'tab',
		indentWidth: '1'
	}).on('error', sass.logError))
	.pipe(postcss([
		autoprefixer('last 2 versions', '> 1%')
	]))
	//.pipe(sourcemaps.write(basePaths.scss + 'maps'))
	.pipe(gulp.dest('./'));
});

gulp.task('images', function() {
	return gulp.src(basePaths.img + 'RAW/**/*.{jpg,JPG,png}')
	.pipe(newer(basePaths.img))
	.pipe(image())
	.pipe(gulp.dest(basePaths.img));
});

gulp.task('javascript', function() {
	return gulp.src([basePaths.js + '*.js'])
	.pipe(jshint())
	.pipe(jshint.reporter('default'))
	.pipe(gulp.dest(basePaths.js));
});

gulp.task('watch', function() {
	gulp.watch(['./**/*.css', './**/*.scss' ], ['css']);
	gulp.watch(basePaths.js + '**/*.js', ['javascript']);
	gulp.watch(basePaths.img + 'RAW/**/*.{jpg,JPG,png}', ['images']);
});

gulp.task('clean-src', function() {
	return del([basePaths.src + '**/*']);
});

gulp.task('copy-assets', ['clean-src'], function() {
	var stream = gulp.src(basePaths.node + 'bootstrap-sass-grid/sass/**/*.scss')
		.pipe(gulp.dest(basePaths.src + 'bootstrap'));

	gulp.src(basePaths.node + 'font-awesome/scss/*.scss')
		.pipe(gulp.dest(basePaths.src + 'font-awesome'));

	gulp.src(basePaths.node + 'font-awesome/fonts/**/*.{ttf,woff,woff2,eof,svg}')
		.pipe(gulp.dest(basePaths.fonts));

	gulp.src(basePaths.node + 'jquery-match-height/dist/jquery.matchHeight-min.js')
		.pipe(gulp.dest(basePaths.js));

	return stream;
});

gulp.task('default', ['watch']);
