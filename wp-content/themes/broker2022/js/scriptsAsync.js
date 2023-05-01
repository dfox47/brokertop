// async script
const scripts = [
	'/wp-content/themes/broker2022/js/async/mango.js',
	'/wp-content/themes/broker2022/js/async/yandexBadge.js',
	// 'https://www.googletagmanager.com/gtag/js?id=UA-129076025-1'
]

document.addEventListener('DOMContentLoaded', () => {
	setTimeout(function() {
		for (let i = 0; i < scripts.length; i++) {
			const $script = document.createElement('script')
			$script.src = scripts[i]
			document.head.appendChild($script)
		}
	}, 5000)
})