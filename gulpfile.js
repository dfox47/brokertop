
let fs          = require('fs')
let concat      = require('gulp-concat')
let config      = JSON.parse(fs.readFileSync('../config.json'))
let cssMinify   = require('gulp-csso')
let ftp         = require('vinyl-ftp')
let gulp        = require('gulp')
let gutil       = require('gulp-util')
let rename      = require('gulp-rename')
let sass        = require('gulp-sass')(require('sass'))
let uglify      = require('gulp-uglify')

// FTP config
let host        = config.host
let password    = config.password
let port        = config.port
let user        = config.user

let remoteFolder                = '/www/brokertop.ru/wp-content/themes/broker2022/'
let remoteFolderCss             = remoteFolder + 'css/'
let remoteFolderJs              = remoteFolder + 'js/'
let remoteFolderTemplateParts   = remoteFolder + 'template-parts/'
let remoteWoocommerce           = remoteFolder + 'woocommerce/'

let localFolder                 = 'wp-content/themes/broker2022/'
let localFolderCss              = localFolder + 'css/'
let localFolderJs               = localFolder + 'js/'
let localFolderTemplateParts    = localFolder + 'template-parts/'
let localWoocommerce            = localFolder + 'woocommerce/'



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

let conn = getFtpConnection()



gulp.task('copy_css', function () {
	return gulp.src(localFolderCss + '**/*.scss')
		.pipe(conn.dest(remoteFolderCss))
})

gulp.task('copy_html', function () {
	return gulp.src(localFolder + '*.php')
		.pipe(conn.dest(remoteFolder))
})

gulp.task('copy_js', function () {
	return gulp.src(localFolderJs + '**/*.js')
		.pipe(conn.dest(remoteFolderJs))
})

gulp.task('copy_template_parts', function () {
	return gulp.src(localFolderTemplateParts + '**/*')
		.pipe(conn.dest(remoteFolderTemplateParts))
})

gulp.task('copy_woocommerce', function () {
	return gulp.src(localWoocommerce + '**/*.php')
		.pipe(conn.dest(remoteWoocommerce))
})

gulp.task('css', function () {
	return gulp.src(localFolderCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			basename: 'style'
		}))
		.pipe(conn.dest(remoteFolder))
})

gulp.task('js', function () {
	return gulp.src([
			localFolderJs + 'jquery-3.6.0.min.js',
			localFolderJs + 'idangerous.chopslider-3.4.js',
			localFolderJs + 'splide.min.js',
			localFolderJs + '**/*.js'
		])
		.pipe(concat('all.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(remoteFolder))
})

gulp.task('watch', function() {
	gulp.watch(localFolder + '*.php',               gulp.series('copy_html'))
	gulp.watch(localFolderCss + '**/*',             gulp.series('css', 'copy_css'))
	gulp.watch(localFolderJs + '**/*.js',           gulp.series('js', 'copy_js'))
	gulp.watch(localFolderTemplateParts + '**/*',   gulp.series('copy_template_parts'))
	gulp.watch(localWoocommerce + '**/*',           gulp.series('copy_woocommerce'))
})

gulp.task('default', gulp.series(
	'watch'
))
