const yandexBadge = () => {
	document.querySelectorAll('.js-yandex-badge').forEach((e) => {
		if (window.pageYOffset + window.innerHeight > e.offsetTop) {
			e.innerHTML = '<iframe class="yandex_badge" src="//yandex.ru/sprav/widget/rating-badge/4782454911"></iframe>'
			e.classList.remove('js-yandex-badge')
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