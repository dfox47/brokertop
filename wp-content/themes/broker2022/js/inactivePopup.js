const inactivePopup = () => {
	const date          = new Date()
	const currentTime   = date.getTime()

	if (parseInt(localStorage.getItem('inactivePopupSeen')) > currentTime) return

	let idleTime = 0

	document.addEventListener('mousemove', resetIdleTime, false)
	document.addEventListener('keypress', resetIdleTime, false)

	function resetIdleTime () {
		idleTime = 0
	}

	function checkIfIdle () {
		idleTime += 1000

		if (idleTime >= 10000) {
			$('.js-popup[data-popup="feedback-7237"]').addClass('active')
			document.getElementsByTagName('html')[0].classList.add('popup_active')
			clearInterval(idleInterval)

			localStorage.setItem('inactivePopupSeen', (currentTime + 2 * 360000).toString())
		}
	}

	let idleInterval = setInterval(checkIfIdle, 1000)
}

inactivePopup()