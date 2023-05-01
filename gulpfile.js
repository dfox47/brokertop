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

const remoteTheme           = '/www/brokertop.ru/wp-content/themes/broker2022/'
const remoteCss             = remoteTheme + 'css/'
const remoteJs              = remoteTheme + 'js/'
const remoteTemplateParts   = remoteTheme + 'template-parts/'
const remoteWCAssets        = '/www/brokertop.ru/wp-content/plugins/woocommerce/assets/css/'
const remoteWCBuild         = '/www/brokertop.ru/wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/'
const remoteWCLibrary       = '/www/brokertop.ru/wp-includes/css/dist/block-library/'

const localTheme            = 'wp-content/themes/broker2022/'
const localCss              = localTheme + 'css/'
const localJs               = localTheme + 'js/'
const localTemplateParts    = localTheme + 'template-parts/'
const localWCAssets         = 'wp-content/plugins/woocommerce/assets/css/'
const localWCBuild          = 'wp-content/plugins/woocommerce/packages/woocommerce-blocks/build/'
const localWCLibrary        = 'wp-includes/css/dist/block-library/'



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
	return gulp.src(localCss + 'styles.scss')
		.pipe(sass())
		.pipe(cssMinify())
		.pipe(rename({
			base: 'style'
			// suffix: ".min"
		}))
		.pipe(conn.dest(remoteTheme))
})

gulp.task('copy_css', function () {
	return gulp.src(localCss + '**/*')
		.pipe(conn.dest(remoteCss))
})

gulp.task('copy_css_wc_blocks', function () {
	return gulp.src(localWCBuild + 'wc-blocks-style.css')
		.pipe(conn.dest(remoteWCBuild))
})

gulp.task('copy_css_wc_default', function () {
	return gulp.src(localWCAssets + 'woocommerce.css')
		.pipe(conn.dest(remoteWCAssets))
})

gulp.task('copy_css_wc_layout', function () {
	return gulp.src(localWCAssets + 'woocommerce-layout.css')
		.pipe(conn.dest(remoteWCAssets))
})

gulp.task('copy_css_wc_library', function () {
	return gulp.src(localWCLibrary + 'style.min.css')
		.pipe(conn.dest(remoteWCLibrary))
})

gulp.task('copy_css_wc_vendors', function () {
	return gulp.src(localWCBuild + 'wc-blocks-vendors-style.css')
		.pipe(conn.dest(remoteWCBuild))
})

gulp.task('copy_html', function () {
	return gulp.src(localTheme + '*.php')
		.pipe(conn.dest(remoteTheme))
})

gulp.task('copy_ajax_pdf', function () {
	return gulp.src('ajax_presentation.php')
		.pipe(conn.dest('/www/brokertop.ru/'))
})

gulp.task('copy_template_parts', function () {
	return gulp.src(localTemplateParts + '**/*')
		.pipe(conn.dest(remoteTemplateParts))
})

gulp.task('copy_js', function () {
	return gulp.src(localJs + '**/*')
		.pipe(conn.dest(remoteJs))
})

gulp.task('js', function () {
	return gulp.src([
			localJs + 'jquery-3.6.0.min.js',
			localJs + 'owl.carousel.min.js',
			localJs + '*.js'
		])
		.pipe(concat('all.js'))
		// .pipe(uglify())
		.pipe(rename({
			suffix: ".min"
		}))
		.pipe(conn.dest(remoteTheme))
})

gulp.task('watch', function() {
	gulp.watch('ajax_presentation.php',                         gulp.series('copy_ajax_pdf'))
	gulp.watch(localCss + '**/*',                               gulp.series('css', 'copy_css'))
	gulp.watch(localJs + '**/*.js',                             gulp.series('js', 'copy_js'))
	gulp.watch(localTemplateParts + '**/*',                     gulp.series('copy_template_parts'))
	gulp.watch(localTheme + '*.php',                            gulp.series('copy_html'))
	gulp.watch(localWCAssets + 'woocommerce-layout.css',        gulp.series('copy_css_wc_layout'))
	gulp.watch(localWCAssets + 'woocommerce.css',               gulp.series('copy_css_wc_default'))
	gulp.watch(localWCBuild + 'wc-blocks-style.css',            gulp.series('copy_css_wc_blocks'))
	gulp.watch(localWCBuild + 'wc-blocks-vendors-style.css',    gulp.series('copy_css_wc_vendors'))
	gulp.watch(localWCLibrary + 'style.min.css',                gulp.series('copy_css_wc_library'))
})

gulp.task('default', gulp.series('watch'))