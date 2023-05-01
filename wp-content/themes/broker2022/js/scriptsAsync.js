// async script
const scripts = [
	'/wp-content/themes/broker2022/js/async/mango.js',
	'/wp-content/themes/broker2022/js/async/yandexBadge.js',
	// 'https://www.googletagmanager.com/gtag/js?id=UA-129076025-1'
]

setTimeout(function() {
	for (let i = 0; i < scripts.length; i++) {
		$('head').append('<script src="' + scripts[i] + '"></script>')
	}
}, 3000)