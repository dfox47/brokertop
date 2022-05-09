
// some special code here
function paginationAjax() {
	let paginationWrap = document.querySelector('.js-pagination-more')

	if (!paginationWrap) return

	let paginationLink = paginationWrap.querySelector('a')

	if (!paginationLink) return

	paginationLink.addEventListener('click', (link) => {
		link.preventDefault()

		let url         = link.target.href
		let request     = new XMLHttpRequest()

		request.open('GET', url)

		request.onreadystatechange = function() {
			if (this.readyState === 4 && this.status === 200) {
				let paginationResult        = document.querySelector('.js-pagination-result')
				paginationResult.innerHTML  = this.responseText

				let paginationMore  = paginationResult.querySelector('.js-pagination-more')
				let newsList        = document.querySelector('.js-news-list')
				let newLi           = paginationResult.querySelectorAll('.js-news-list li')

				// remove used button
				paginationWrap.remove()

				// reinit pagination button
				if (paginationMore) {
					newsList.after(paginationMore)

					// enable script for the AJAX button
					paginationAjax()
				}

				// append new elements to the list
				newLi.forEach((li) => {
					newsList.appendChild(li)
				})
			}
		}

		request.send()
	})
}

paginationAjax()
