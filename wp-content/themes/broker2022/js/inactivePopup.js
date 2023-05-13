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
		clearInterval(idleInterval)
	}
}

let idleInterval = setInterval(checkIfIdle, 1000)