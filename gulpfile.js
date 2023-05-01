const fs            = require('fs')
const concat        = require('gulp-concat')
const config        = JSON.parse(fs.readFileSync('../config.json'))
const cssMinify     = require('gulp-csso')
const ftp           = require('vinyl-ftp')
const gulp          = require('gulp')
const gutil         = require('gulp-util')
const rename        = require('gulp-rename')
const sass          = require('gulp-sass')(require('sass'))
const uglify        = require('gulp-uglify')

// FTP config
const host          = config.host
const password      = config.password
const port          = config.port
const user          = config.user

const remoteFolder                  = '/www/brokertop.ru/wp-content/themes/broker2022/'
const remoteFolderCss               = remoteFolder + 'css/'
const remoteFolderJs                = remoteFolder + 'js/'
const remoteFolderTemplateParts     = remoteFolder + 'template-parts/'

const localFolder                   = 'wp-content/themes/broker2022/'
const localFolderCss                = localFolder + 'css/'
const localFolderJs                 = localFolder + 'js/'
const localFolderTemplateParts      = localFolder + 'template-parts/'



function getFtpConnection() {
	return ftp.create({
		host:           host,
		log:            gutil.log,
		password:       password,
		parallel:       3,
		port:           port,
		user:           user
	})
}

const conn = getFtpConnection()



gulp.task('css', function () {
	return gulp.src(localFolderCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			base: 'style'
			// suffix: ".min"
		}))
		.pipe(conn.dest(remoteFolder))
})

gulp.task('copy_css', function () {
	return gulp.src(localFolderCss + '**/*')
		.pipe(conn.dest(remoteFolderCss))
})

gulp.task('copy_html', function () {
	return gulp.src(localFolder + '*.php')
		.pipe(conn.dest(remoteFolder))
})

gulp.task('copy_ajax_pdf', function () {
	return gulp.src('ajax_presentation.php')
		.pipe(conn.dest('/www/brokertop.ru/'))
})

gulp.task('copy_template_parts', function () {
	return gulp.src(localFolderTemplateParts + '**/*')
		.pipe(conn.dest(remoteFolderTemplateParts))
})

gulp.task('copy_js', function () {
	return gulp.src(localFolderJs + '**/*')
		.pipe(conn.dest(remoteFolderJs))
})

gulp.task('js', function () {
	return gulp.src([
			localFolderJs + 'jquery-3.6.0.min.js',
			localFolderJs + 'owl.carousel.min.js',
			localFolderJs + '*.js'
		])
		.pipe(concat('all.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(remoteFolder))
})

gulp.task('watch', function() {
	gulp.watch('ajax_presentation.php',             gulp.series('copy_ajax_pdf'))
	gulp.watch(localFolder + '*.php',               gulp.series('copy_html'))
	gulp.watch(localFolderCss + '**/*',             gulp.series('css', 'copy_css'))
	gulp.watch(localFolderJs + '**/*.js',           gulp.series('js', 'copy_js'))
	gulp.watch(localFolderTemplateParts + '**/*',   gulp.series('copy_template_parts'))
})

gulp.task('default', gulp.series('watch'))
