const yandexBadge = () => {
	document.querySelectorAll('.js-yandex-badge').forEach((e) => {
		console.log('window.pageYOffset | ', window.pageYOffset)
		console.log('window.innerHeight | ', window.innerHeight)
		console.log('e.offsetTop | ', e.offsetTop)

		if (window.pageYOffset + window.innerHeight > e.offsetTop) {
			e.innerHTML = '<iframe class="yandex_badge" src="//yandex.ru/sprav/widget/rating-badge/4782454911"></iframe>'
		}
	})
}

yandexBadge()

window.addEventListener('resize', function() {
	yandexBadge()
})

window.addEventListener('scroll', function() {
	yandexBadge()
})